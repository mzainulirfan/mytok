<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsModel;
use App\Models\UsersModel;
use App\Models\OrdersModel;
use App\Models\AddressModel;
use App\Models\ItemOrderModel;

class Orders extends BaseController
{
    protected $productModel;
    protected $userModel;
    protected $orderModel;
    protected $addressModel;
    protected $itemOrderModel;

    public function __construct()
    {
        $this->productModel = new ProductsModel();
        $this->userModel = new UsersModel();
        $this->orderModel = new OrdersModel();
        $this->addressModel = new AddressModel();
        $this->itemOrderModel = new ItemOrderModel();
    }

    public function index()
    {
        $orders = $this->orderModel->getAllOrders();
        $data = [
            'title' => 'orders',
            'orders' => $orders
        ];
        return view('orders/index', $data);
    }

    public function addToCart()
    {
        // Get data from POST request
        $productId = $this->request->getPost('productId');
        $product = $this->productModel->find($productId);
        $productName = $product['product_name'];
        $productPrice = $product['product_price'];
        $productSlug = $product['product_slug'];
        $productStock = $product['product_stock'];
        $productQty = $this->request->getPost('productQty');

        // Validate inputs
        if (!$productName || !$productPrice || !$productQty) {
            return redirect()->back()->with('error', 'Invalid product data.');
        }

        // Initialize session if not already
        if (!session()->has('cart')) {
            session()->set('cart', []);
        }

        // Get cart from session
        $cart = session()->get('cart');
        $productFound = false;

        // Check if product already in cart
        foreach ($cart as &$item) {
            if ($item['product_name'] === $productName) {
                // Ensure 'quantity' key exists and update quantity
                if (!isset($item['quantity'])) {
                    $item['quantity'] = 0;
                }
                $item['quantity'] += $productQty;
                $productFound = true;
                break;
            }
        }

        // If product not found in cart, add as new item
        if (!$productFound) {
            $cart[] = [
                'product_id' => $productId,
                'product_name' => $productName,
                'product_price' => $productPrice,
                'product_slug' => $productSlug,
                'product_stock' => $productStock,
                'quantity' => $productQty
            ];
        }

        // Save cart to session
        session()->set('cart', $cart);

        // Redirect or perform other operations
        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }
    public function updateItemQty()
    {
        $productId = $this->request->getPost('productId');
        $productQty = $this->request->getPost('productQty');

        if ($productQty <= 0) {
            return redirect()->back()->with('error', 'Quantity must be greater than zero.');
        }

        $cart = session()->get('cart');
        foreach ($cart as &$item) {
            if ($item['product_id'] === $productId) {
                $item['quantity'] = $productQty;
                break;
            }
        }

        session()->set('cart', $cart);

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }


    public function createOrder()
    {
        // Ambil data keranjang belanja dari session
        $cartItems = session()->get('cart') ?? [];
        $sessionUserId = session()->get('user_id');
        // dd();
        $addresses = $this->addressModel->findAll();
        $userMainAddress = $this->addressModel->where('address_user_id', $sessionUserId)->where('address_is_main', 1)->first();
        $userAddress = $this->addressModel->where('address_user_id', $sessionUserId)->findAll();
        $user = $this->userModel->find($sessionUserId);
        // dd($sessionUserId, $userAddress);

        // Hitung total jumlah quantity
        $totalQuantity = 0;
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            // Pastikan kunci 'quantity' ada
            if (!isset($item['quantity'])) {
                $item['quantity'] = 1;
            }
            $totalQuantity += $item['quantity'];
            $totalPrice += $item['quantity'] * $item['product_price'];
        }

        $data = [
            'title' => 'cart',
            'cartItems' => $cartItems,
            'totalQuantity' => $totalQuantity,
            'addresses' => $userAddress,
            'userAddress' => $userMainAddress,
            'user' => $user,
            'totalPrice' => $totalPrice //
        ];
        return view('orders/create', $data);
    }
    public function removeFromCart()
    {
        // Ambil nama produk yang akan dihapus dari POST request
        $productName = $this->request->getPost('productName');

        // Ambil keranjang belanja dari session
        $cart = session()->get('cart');

        // Cari produk yang akan dihapus dari keranjang
        foreach ($cart as $key => $item) {
            if ($item['product_name'] === $productName) {
                // Hapus produk dari keranjang
                unset($cart[$key]);
                break;
            }
        }

        // Simpan keranjang belanja yang diperbarui ke session
        session()->set('cart', $cart);

        // Redirect atau lakukan operasi lainnya
        return redirect()->back()->with('success', 'Product removed from cart successfully.');
    }

    public function clearCart()
    {
        // Hapus semua item di keranjang
        session()->remove('cart');

        // Redirect atau lakukan operasi lainnya
        return redirect()->back()->with('success', 'Cart cleared successfully.');
    }
    public function updateCartItem()
    {
        $productId = $this->request->getPost('productId');
        $quantity = $this->request->getPost('quantity');

        // Ambil data keranjang belanja dari session
        $cartItems = session()->get('cart') ?? [];

        // Update quantity untuk produk yang bersangkutan
        foreach ($cartItems as &$item) {
            if ($item['product_id'] == $productId) {
                $item['quantity'] = $quantity;
                break;
            }
        }

        // Simpan kembali data keranjang belanja ke session
        session()->set('cart', $cartItems);

        return redirect()->to(base_url('cart'));
    }
    public function checkout()
    {
        // Ambil data keranjang belanja dari session
        $cartItems = session()->get('cart') ?? [];
        $orderBy = session()->get('user_id');
        // $productQty = [];
        // foreach ($cartItems as $item) {
        //     $productQty[] = $item['quantity'];
        // }

        // dd($productQty);
        $data = [
            'order_total_amount' =>  $this->request->getVar('totalAmount'),
            'order_user_id' => $orderBy,
            'order_payment_status' => 'unpaid',
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->orderModel->save($data);
        $orderId = $this->orderModel->getInsertID();

        // Simpan data ke tabel order_items
        foreach ($cartItems as $item) {
            $orderItemData = [
                'item_order_order_id' => $orderId,
                'item_order_product_id' => $item['product_id'],
                'item_order_qty' => $item['quantity']
            ];
            $this->itemOrderModel->save($orderItemData);
        }

        // kurangi stok
        foreach ($cartItems as $item) {
            $productId = $item['product_id'];
            $product = $this->productModel->find($productId);
            $currentStock = $product['product_stock'];
            $itemQty = $item['quantity'];
            $itemData = [
                'product_stock' => $currentStock - $itemQty
            ];
            $this->productModel->update($productId, $itemData);
        }

        session()->remove('cart');
        return redirect()->to('orders');
    }


    public function orderDetail($orderId)
    {
        $order = $this->orderModel->find($orderId);
        $orderItems = $this->itemOrderModel->getRelatedProductWithOrder($orderId);
        $data = [
            'title' => 'order detail #order' . $order['order_id'],
            'order' => $order,
            'orderItems' => $orderItems
        ];
        return view('orders/detail', $data);
    }
}

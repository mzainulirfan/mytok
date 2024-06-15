<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsModel;
use App\Models\OrdersModel;
use App\Models\ItemOrderModel;

class Orders extends BaseController
{
    protected $productModel;
    protected $orderModel;
    protected $itemOrderModel;

    public function __construct()
    {
        $this->productModel = new ProductsModel();
        $this->orderModel = new OrdersModel();
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
        $productName = $this->request->getPost('productName');
        $productPrice = $this->request->getPost('productPrice');
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
                'quantity' => $productQty
            ];
        }

        // Save cart to session
        session()->set('cart', $cart);

        // Redirect or perform other operations
        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }


    public function createOrder()
    {
        // Ambil data keranjang belanja dari session
        $cartItems = session()->get('cart') ?? [];

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
            'title' => 'create order',
            'products' => $this->productModel->getAllProductsPublish(),
            'cartItems' => $cartItems, // Kirim data keranjang belanja ke tampilan
            'totalQuantity' => $totalQuantity,
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
    public function checkout()
    {
        // Ambil data keranjang belanja dari session
        $cartItems = session()->get('cart') ?? [];

        $data = [
            'order_total_amount' =>  $this->request->getVar('totalAmount'),
            'order_user_id' => 1,
            // 'order_payment_status' => ''
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

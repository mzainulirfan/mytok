<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductsModel;

class Orders extends BaseController
{
    protected $productModel;

    public function __construct()
    {
        $this->productModel = new ProductsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'order'
        ];
        return view('orders/index', $data);
    }

    // public function addToCart()
    // {
    //     // dd($this->request->getPost());
    //     // Ambil data dari POST request
    //     $productName = $this->request->getPost('productName');
    //     $productPrice = $this->request->getPost('productPrice');
    //     $productQty = $this->request->getPost('productQty');

    //     // Inisialisasi session jika belum ada
    //     if (!session()->has('cart')) {
    //         session()->set('cart', []);
    //     }

    //     // Ambil keranjang belanja dari session
    //     $cart = session()->get('cart');
    //     $productFound = false;

    //     // Cek apakah produk sudah ada di keranjang
    //     foreach ($cart as &$item) {
    //         if ($item['product_name'] === $productName) {
    //             // Pastikan kunci 'quantity' ada
    //             if (!isset($item['quantity'])) {
    //                 $item['quantity'] = 0;
    //             }
    //             $item['quantity'] += 1;
    //             $productFound = true;
    //             break;
    //         }
    //     }

    //     // Jika produk tidak ditemukan di keranjang, tambahkan sebagai item baru
    //     if (!$productFound) {
    //         $cart[] = [
    //             'product_name' => $productName,
    //             'product_price' => $productPrice,
    //             'quantity' => 1
    //         ];
    //     }

    //     // Simpan keranjang belanja ke session
    //     session()->set('cart', $cart);

    //     // Redirect atau lakukan operasi lainnya
    //     return redirect()->back()->with('success', 'Product added to cart successfully.');
    // }
    public function addToCart()
    {
        // Get data from POST request
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
        foreach ($cartItems as $item) {
            // Pastikan kunci 'quantity' ada
            if (!isset($item['quantity'])) {
                $item['quantity'] = 1;
            }
            $totalQuantity += $item['quantity'];
        }

        $data = [
            'title' => 'create order',
            'products' => $this->productModel->getAllProductsPublish(),
            'cartItems' => $cartItems, // Kirim data keranjang belanja ke tampilan
            'totalQuantity' => $totalQuantity,
            // 'totalPrice' => $totalPrice //
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
}

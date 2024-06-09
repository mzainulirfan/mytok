<?php

namespace App\Cells;

class CartTotalHelper
{
  public function display()
  {
    // Ambil data keranjang belanja dari session
    $cartItems = session()->get('cart') ?? [];

    // Hitung total jumlah quantity
    $totalQuantity = 0;
    foreach ($cartItems as $item) {
      if (!isset($item['quantity'])) {
        $item['quantity'] = 1;
      }
      $totalQuantity += $item['quantity'];
    }


    return view('cells/cart_total', ['totalQuantity' => $totalQuantity]);
  }
  public function totalPrice()
  {
    // Ambil data keranjang belanja dari session
    $cartItems = session()->get('cart') ?? [];

    // Hitung total harga
    $totalPrice = 0;
    foreach ($cartItems as $item) {
      if (!isset($item['quantity']) || !isset($item['product_price'])) {
        continue;
      }
      $totalPrice += $item['quantity'] * $item['product_price'];
    }
    return view('cells/price_total', ['totalPrice' => $totalPrice]);
  }
}

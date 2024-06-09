<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Orders extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'order'
        ];
        return view('orders/index', $data);
    }
    public function createOrder()
    {
        $data = [
            'title' => 'create order'
        ];
        return view('orders/create', $data);
    }
}

<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductsModel;

class Products extends BaseController
{
    private $productModel;
    public function __construct()
    {
        $this->productModel = new ProductsModel();
    }
    public function index()
    {
        $data = [
            'title' => 'products',
            'products' => $this->productModel->getAllProducts(),
            'productsCount' => $this->productModel->countAllResults()
        ];
        return view('products/index', $data);
    }
    public function createProduct()
    {
        $data = [
            'title' => 'create product'
        ];
        return view('products/create', $data);
    }
    public function saveProduct()
    {
        $productName =  $this->request->getVar('productName');
        $data = [
            'product_name' =>  $productName,
            'product_price' =>  $this->request->getVar('productPrice'),
            'product_stock' =>  $this->request->getVar('productStock'),
            'product_slug' =>  url_title($productName, '-', true),
            'product_category' =>  $this->request->getVar('productCategory'),
            'product_desc' =>  $this->request->getVar('productDescription'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->productModel->save($data);
        return redirect()->to(base_url() . 'product');
    }
}

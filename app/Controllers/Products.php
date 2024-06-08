<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductsModel;
use App\Models\CategoriesModel;

class Products extends BaseController
{
    private $productModel;
    private $categoryModel;
    public function __construct()
    {
        $this->productModel = new ProductsModel();
        $this->categoryModel = new CategoriesModel();
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
            'title' => 'create product',
            'categories' => $this->categoryModel->findAll()
        ];
        return view('products/create', $data);
    }
    public function saveProduct()
    {
        $productName =  $this->request->getVar('productName');
        $validationRules = [
            'productName' => 'required|min_length[5]|is_unique[products.product_name]',
            'productStock' => 'required|numeric',
            'productPrice' => 'required|numeric',
            'productCategory' => 'required',
            'productDescription' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

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
        session()->setFlashdata('success', 'product has been seved successfully');
        return redirect()->to(base_url() . 'product');
    }
    public function editProduct($slugProduct)
    {
        $data = [
            'title' => 'edit product',
            'product' => $this->productModel->getDetailProduct($slugProduct),
            'categories' => $this->categoryModel->findAll()
        ];
        return view('products/edit', $data);
    }
}

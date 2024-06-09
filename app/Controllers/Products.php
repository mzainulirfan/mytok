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
        $isActive = $this->request->getVar('isActive') === 'on' ? 1 : 0;
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
            'product_is_active' =>  $isActive,
            'created_at' => date('Y-m-d H:i:s'),
        ];
        $this->productModel->save($data);
        session()->setFlashdata('success', 'product has been seved successfully');
        return redirect()->to(base_url() . 'product');
    }
    public function detailProduct($slugProduct)
    {
        $product = $this->productModel->where('product_slug', $slugProduct)->first();
        if (!$product) {
            return "<script>alert('Product $slugProduct not found'); window.location.href = '" . base_url() . "product';</script>";
        }
        $productName = $product['product_name'];
        $data = [
            'title' => $productName,
            'product' => $this->productModel->getDetailProduct($slugProduct)
        ];
        return view('products/detail', $data);
    }
    public function editProduct($slugProduct)
    {
        $product = $this->productModel->where('product_slug', $slugProduct)->first();
        if (!$product) {
            return redirect()->to(base_url() . 'product');
        }
        $productName = $product['product_name'];
        $data = [
            'title' => 'edit ' . $productName,
            'product' => $this->productModel->getDetailProduct($slugProduct),
            'categories' => $this->categoryModel->findAll()
        ];
        return view('products/edit', $data);
    }
    public function updateProduct($productId)
    {
        $isActive = $this->request->getVar('isActive') === 'on' ? 1 : 0;
        $newProductName =  $this->request->getVar('productName');
        $product = $this->productModel->find($productId);
        $currentProductName = $product['product_name'];
        if ($newProductName == $currentProductName) {
            $productNameRules = 'required|min_length[5]';
        } else {
            $productNameRules = 'required|min_length[5]|is_unique[products.product_name]';
        }
        $validationRules = [
            'productName' => $productNameRules,
            'productStock' => 'required|numeric',
            'productPrice' => 'required|numeric',
            'productCategory' => 'required',
            'productDescription' => 'required',
        ];
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'product_id' =>  $this->request->getVar('productId'),
            'product_name' =>  $newProductName,
            'product_price' =>  $this->request->getVar('productPrice'),
            'product_stock' =>  $this->request->getVar('productStock'),
            'product_category' =>  $this->request->getVar('productCategory'),
            'product_desc' =>  $this->request->getVar('productDescription'),
            'product_is_active' =>  $isActive,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->productModel->save($data);
        session()->setFlashdata('success', 'product has been updated successfully');
        return redirect()->to(base_url() . 'product');
    }
    public function deleteProduct($productId)
    {
        $this->productModel->delete($productId);
        session()->setFlashdata('success', 'product has been deleted successfully');
        return redirect()->to('product');
    }
}

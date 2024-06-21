<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ProductsModel;
use App\Models\usersModel;
use App\Models\CategoriesModel;
use App\Models\UpdateStockModel;

class Products extends BaseController
{
    private $productModel;
    private $userModel;
    private $categoryModel;
    private $stockModel;

    public function __construct()
    {
        $this->productModel = new ProductsModel();
        $this->userModel = new UsersModel();
        $this->categoryModel = new CategoriesModel();
        $this->stockModel = new UpdateStockModel();
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

        $productNameRules = ($newProductName == $currentProductName) ? 'required|min_length[5]' : 'required|min_length[5]|is_unique[products.product_name]';

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
    public function updateProductStock()
    {
        $productId =  $this->request->getVar('productId');
        $product = $this->productModel->find($productId);
        // dd($product);
        $currentStockQty = $product['product_stock'];

        $productName =  $this->request->getVar('productName');
        $newStockQty =  $this->request->getVar('productStockQty');
        $updateStockBy = session()->get('user_id');
        // dd($updateStockBy);
        $dataStock = [
            'update_stock_product_id' => $productId,
            'update_stock_update_by' => $updateStockBy,
            'update_stock_qty' => $newStockQty,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->stockModel->save($dataStock);

        $data = [
            'product_id' =>  $productId,
            'product_stock' =>  $currentStockQty + $newStockQty,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->productModel->update($productId, $data);
        session()->setFlashdata('success', 'stock product ' . $productName . ' has been updated successfully');
        return redirect()->to(base_url() . 'product');
    }
    public function clearStock()
    {
        $productId =  $this->request->getVar('productIdClear');
        $productName =  $this->request->getVar('productNameClear');
        $clearStock = 0;
        // dd($idProduct, $productName, $clearStock);
        $data = [
            'product_stock' => $clearStock
        ];
        $this->productModel->update($productId, $data);
        session()->setFlashdata('success', 'stock product ' . $productName . ' has been updated successfully');
        return redirect()->to(base_url() . 'product');
    }
    public function deleteProduct($productId)
    {
        $this->productModel->delete($productId);
        session()->setFlashdata('success', 'product has been deleted successfully');
        return redirect()->to('product');
    }
}

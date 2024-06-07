<?php

namespace App\Controllers;

use App\Models\ProductsModel;
use App\Models\CategoriesModel;

class Home extends BaseController
{
    private $categoryModel;
    private $productModel;
    public function __construct()
    {
        $this->categoryModel = new CategoriesModel();
        $this->productModel = new ProductsModel();
    }
    public function index(): string
    {
        $data = [
            'title' => 'dashboard',
            'countProducts' => $this->productModel->countAllResults(),
            'countCategories' => $this->categoryModel->countAllResults()
        ];
        return view('home/index', $data);
    }
}

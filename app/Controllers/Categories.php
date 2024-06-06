<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoriesModel;

class Categories extends BaseController
{
    private $categoryModel;
    public function __construct()
    {
        $this->categoryModel = new CategoriesModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Categiriess',
            'categories' => $this->categoryModel->findAll(),
            'categoriesCount' => $this->categoryModel->countAllResults()
        ];
        return view('categories/index', $data);
    }
    public function createcategories()
    {
        $data = [
            'title' => 'create category'
        ];
        return view('categories/create', $data);
    }
}

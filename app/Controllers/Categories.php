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
            'title' => 'Categories',
            'categories' => $this->categoryModel->findAll(),
            'categoriesCount' => $this->categoryModel->countAllResults()
        ];
        return view('categories/index', $data);
    }
    public function createCategories()
    {
        $data = [
            'title' => 'Create category'
        ];
        return view('categories/create', $data);
    }
    public function saveCategory()
    {
        $categoryName =  $this->request->getVar('categoryName');
        $categoryValidationRules = [
            'categoryName' => 'required|min_length[5]|is_unique[categories.category_name]',
            'categoryDescription' => 'required|min_length[5]',
        ];
        if (!$this->validate($categoryValidationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $data = [
            'category_name' =>  $categoryName,
            'category_slug' =>  url_title($categoryName, '-', true),
            'category_description' =>  $this->request->getVar('categoryDescription'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->categoryModel->save($data);
        session()->setFlashdata('success', 'category has been seved successfully');
        return redirect()->to('categories');
    }
    public function editCategories($categorySlug)
    {
        $data = [
            'title' => 'Edit category',
            'category' => $this->categoryModel->where('category_slug', $categorySlug)->first()
        ];
        return view('categories/edit', $data);
    }
    public function udpateCategory($categoryId)
    {
        $newCategoryName =  $this->request->getVar('categoryName');
        $category = $this->categoryModel->where('category_id', $categoryId)->first();
        $currentCategoryName = $category['category_name'];
        if ($newCategoryName == $currentCategoryName) {
            $categoryNameRules = 'required|min_length[5]';
        } else {
            $categoryNameRules = 'required|min_length[5]|is_unique[categories.category_name]';
        }
        $categoryValidationRules = [
            'categoryName' => $categoryNameRules,
            'categoryDescription' => 'required|min_length[5]|max_length[100]',
        ];
        if (!$this->validate($categoryValidationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $data = [
            'category_id' =>  $this->request->getVar('categoryId'),
            'category_name' =>  $newCategoryName,
            'category_description' =>  $this->request->getVar('categoryDescription'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->categoryModel->save($data);
        return redirect()->to('categories');
    }
}

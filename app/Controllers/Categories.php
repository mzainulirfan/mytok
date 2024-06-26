<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\CategoriesModel;
use App\Models\ProductsModel;

class Categories extends BaseController
{
    private $categoryModel;
    private $productModel;
    public function __construct()
    {
        $this->categoryModel = new CategoriesModel();
        $this->productModel = new ProductsModel();
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
            session()->setFlashdata('errors', 'errors');
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $data = [
            'category_name' =>  $categoryName,
            'category_description' =>  $this->request->getVar('categoryDescription'),
            'category_slug' =>  url_title($categoryName, '-', true),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->categoryModel->save($data);
        session()->setFlashdata('success', 'category has been saved successfully');
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
    public function detailCategories($categorySlug)
    {
        $category = $this->categoryModel->where('category_slug', $categorySlug)->first();
        $categoryId = $category['category_id'];
        $relatedCategory = $this->productModel->where('product_category', $categoryId)->findAll();
        $data = [
            'title' => 'detail category',
            'category' => $this->categoryModel->where('category_slug', $categorySlug)->first(),
            'relatedCategory' => $relatedCategory
        ];
        return view('categories/detail', $data);
    }
    public function udpateCategory($categoryId)
    {
        $categoryIds =  $this->request->getVar('categoryId');
        $newCategoryName =  $this->request->getVar('categoryName');
        $category = $this->categoryModel->find($categoryIds);
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
            'category_id' => $categoryIds,
            'category_name' =>  $newCategoryName,
            'category_description' =>  $this->request->getVar('categoryDescription'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->categoryModel->update($categoryIds, $data);
        session()->setFlashdata('success', 'category has been updated successfully');
        return redirect()->to('categories');
    }
    public function deleteCategory($categoryId)
    {
        $relatedProducts = $this->productModel->where('product_category', $categoryId)->findAll();
        if (!empty($relatedProducts)) {
            return "<script>alert('Cannot delete category because there are related products.'); window.location.href = '" . base_url() . "categories';</script>";
        }
        $this->categoryModel->delete($categoryId);
        session()->setFlashdata('success', 'category has been deleted successfully');
        return redirect()->to('categories');
    }
}

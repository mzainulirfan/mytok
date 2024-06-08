<?php

namespace App\Models;

use App\Controllers\Categories;
use CodeIgniter\Model;

class ProductsModel extends Model
{
    protected $table            = 'products';
    protected $primaryKey       = 'product_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'product_name',
        'product_price',
        'product_is_active',
        'product_stock',
        'product_slug',
        'product_category',
        'product_desc',
        'created_at',
        'updated_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getAllProducts()
    {
        return $this->db->table($this->table)
            ->select('products.*, categories.category_name, categories.category_slug')
            ->join('categories', 'categories.category_id=products.product_category')
            ->get()
            ->getResultArray();
    }
    public function getDetailProduct($slugProduct)
    {
        return $this->db->table($this->table)
            ->select('products.*, categories.category_name')
            ->join('categories', 'categories.category_id=products.product_category')
            ->where('product_slug', $slugProduct)
            ->get()
            ->getRowArray();
    }
}

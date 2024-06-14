<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemOrderModel extends Model
{
    protected $table            = 'item_orders';
    protected $primaryKey       = 'item_order_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'item_order_order_id',
        'item_order_product_id',
        'item_order_qty'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
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
    // public function getRelatedProductWithOrder($orderId)
    // {
    //     return $this->db->table($this->table)
    //         ->select('item_orders.*, products.*')
    //         ->join('products', 'products.product_id=item_orders.item_order_order_id')
    //         ->join('orders', 'orders.order_id=item_orders.item_order_order_id')
    //         ->where('item_order_order_id', $orderId)
    //         ->get()
    //         ->getResultArray();
    // }
    public function getRelatedProductWithOrder($orderId)
    {
        return $this->db->table('item_orders')
            ->select('item_orders.*, products.*, orders.*')
            ->join('products', 'products.product_id = item_orders.item_order_product_id')
            ->join('orders', 'orders.order_id = item_orders.item_order_order_id')
            ->where('item_orders.item_order_order_id', $orderId)
            ->get()
            ->getResultArray();
    }

}

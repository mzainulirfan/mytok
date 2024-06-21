<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'product_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'product_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'product_price' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'product_is_active' => [
                'type' => 'BOOLEAN', 
                'default' => 1,
                'null' => true
            ],
            'product_stock' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => true
            ],
            'product_slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'product_category' => [
                'type' => 'INT', 
                'constraint' => 5,
                'unsigned' => true,
            ],
            'product_desc' => [
                'type' => 'TEXT'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        $this->forge->addKey('product_id', true);
        $this->forge->addForeignKey('product_category', 'categories', 'category_id', 'restrict', 'cascade');
        $this->forge->createTable('products', true);
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}

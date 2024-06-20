<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUpdateStockTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'update_stock_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'update_stock_product_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'update_stock_value' => [
                'type' => 'INT',
                'constraint' => 10,
                'null' => true
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
        $this->forge->addKey('update_stock_id', true);
        $this->forge->addForeignKey('update_stock_product_id', 'products', 'product_id', 'restrict', 'cascade');
        $this->forge->createTable('update_stocks', true);
    }

    public function down()
    {
        $this->forge->dropTable('update_stocks', true);
    }
}

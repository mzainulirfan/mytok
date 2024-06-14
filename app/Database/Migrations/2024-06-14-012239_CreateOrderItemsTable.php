<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderItemsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'item_order_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'item_order_product_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true
            ],
            'item_order_qty' => [
                'type' => 'INT',
                'constraint' => 5,
                'null' => true
            ],
            'item_order_order_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => true
            ]
        ]);
        $this->forge->addKey('item_order_id', true);
        $this->forge->createTable('item_orders', true);
    }

    public function down()
    {
        $this->forge->dropTable('item_orders');
    }
}

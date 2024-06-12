<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'order_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'order_total_amount' => [
                'type' => 'INT',
                'constraint' => 255,
                'null' => true
            ],
            'order_status' => [
                'type' => 'ENUM',
                'constraint' => ['Pending', 'Done'],
                'default' => 'Pending',
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
        $this->forge->addKey('order_id', true);
        $this->forge->createTable('orders', true);
    }

    public function down()
    {
        $this->forge->dropTable('orders');
    }
}

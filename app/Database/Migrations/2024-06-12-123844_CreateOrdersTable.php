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
            'order_user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true
            ],
            'order_total_amount' => [
                'type' => 'INT',
                'constraint' => 255,
                'null' => true
            ],
            'order_payment_status' => [
                'type' => 'ENUM',
                'constraint' => ['paid', 'unpaid'],
                'default' => 'unpaid',
            ],
            'order_status' => [
                'type' => 'ENUM',
                'constraint' => ['pending', 'on process', 'success', 'cancel'],
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

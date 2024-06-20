<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateImageProductsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'image_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'image_product_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'image_name' => [
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => true
            ],
            'image_is_main' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
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
        $this->forge->addKey('image_id', true);
        $this->forge->addForeignKey('image_product_id', 'products', 'product_id', 'restrict', 'cascade');
        $this->forge->createTable('image_products', true);
    }

    public function down()
    {
        $this->forge->dropTable('image_Products', true);
    }
}

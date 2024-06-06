<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCategoriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'category_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'category_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'category_slug' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'category_description' => [
                'type' => 'TEXT',
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
        $this->forge->addKey('category_id', true);
        $this->forge->createTable('categories', true);
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}

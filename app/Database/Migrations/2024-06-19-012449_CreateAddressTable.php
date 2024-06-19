<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateAddressTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'address_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'address_line' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'address_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'address_phone' => [
                'type' => 'INT',
                'constraint' => 15,
                'null' => true
            ],
            'address_kecamatan' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'address_kabupaten' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'address_province' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true
            ],
            'address_postal_code' => [
                'type' => 'INT',
                'constraint' => 255,
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
        $this->forge->addKey('address_id', true);
        $this->forge->createTable('addresses', true);
    }

    public function down()
    {
        $this->forge->dropTable('addresses');
    }
}

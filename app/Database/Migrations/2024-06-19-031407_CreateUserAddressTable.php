<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserAddressTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_address_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'user_address_address_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'user_address_user_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'user_address_is_main' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => false,
            ]
        ]);
        $this->forge->addKey('user_address_id', true);
        $this->forge->addForeignKey('user_address_user_id', 'users', 'user_id', 'restrict', 'cascade');
        $this->forge->addForeignKey('user_address_address_id', 'addresses', 'address_id', 'restrict', 'cascade');
        $this->forge->createTable('user_addresses', true);
    }

    public function down()
    {
        $this->forge->dropTable('user_addresses');
    }
}

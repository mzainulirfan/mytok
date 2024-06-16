<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserstable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'user_id' => [
                'type' => 'INT',
                'constraint' => '5',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'fullname_user' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'username_user' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'email_user' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'phone_user' => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            'gender_user' => [
                'type' => 'ENUM',
                'constraint' => ['male', 'female'],
                'default' => 'male',
                'null' => true
            ],
            'is_active_user' => [
                'type' => 'BOOLEAN',
                'default' => true
            ],
            'password_user' => [
                'type' => 'VARCHAR',
                'constraint' => 255
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
        $this->forge->addKey('user_id', true);
        $this->forge->createTable('users', true);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}

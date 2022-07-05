<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'userId' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            "username" => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            "password" => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ]
        ]);
        $this->forge->addPrimaryKey("userId");
        $this->forge->createTable("users");
    }

    public function down()
    {
        $this->forge->dropTable("users");
    }
}

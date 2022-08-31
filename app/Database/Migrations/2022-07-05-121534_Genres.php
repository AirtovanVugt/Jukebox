<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Genres extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'genreId' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'genre' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ]
        ]);
        $this->forge->addPrimaryKey("genreId");
        $this->forge->createTable("genres");
    }

    public function down()
    {
        $this->forge->dropTable("genres");
    }
}

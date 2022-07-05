<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Songs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "songId" => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            "nameSong" => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            "lyrics" => [
                'type'           => 'TEXT'
            ],
            "tijd" => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            "genreId" => [
                'type'           => 'INT',
                'constraint'     => 11
            ]
        ]);
        $this->forge->addPrimaryKey("songId");
        $this->forge->createTable("songs");
    }

    public function down()
    {
        $this->forge->dropTable("songs");
    }
}

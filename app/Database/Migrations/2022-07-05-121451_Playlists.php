<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Playlists extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "playlistId" => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            "namePlaylist" => [
                'type'           => 'VARCHAR',
                'constraint'     => 255
            ],
            "userId" => [
                'type'           => 'INT',
                'constraint'     => 11
            ]
        ]);
        $this->forge->addPrimaryKey("playlistId");
        $this->forge->createTable("playlists");
    }

    public function down()
    {
        $this->forge->dropTable("playlists");
    }
}

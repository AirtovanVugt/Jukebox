<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Songplaylist extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'songplaylistId' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            "playlistId" => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            "userId" => [
                'type'           => 'INT',
                'constraint'     => 11
            ],
            "songId" => [
                'type'           => 'INT',
                'constraint'     => 11
            ]
        ]);
        $this->forge->addPrimaryKey("songplaylistId");
        $this->forge->createTable("songPlaylist");
    }

    public function down()
    {
        $this->forge->dropTable("songPlaylists");
    }
}

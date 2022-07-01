<?php

namespace App\Models;

class getPlaylist extends \CodeIgniter\Model{

    protected $table = "playlists";

    protected $allowedFields = ["namePlaylist", "UserId"];
}
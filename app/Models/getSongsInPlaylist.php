<?php

namespace App\Models;

class getSongsInPlaylist extends \CodeIgniter\Model{

    protected $table = "songplaylist";

    protected $allowedFields = ["playlistId", "songId", "UserId"];

    
}
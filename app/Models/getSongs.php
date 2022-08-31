<?php

namespace App\Models;

class getSongs extends \CodeIgniter\Model{

    protected $table = "songs";

    protected $allowedFields = ["nameSong", "lyrics", "time", "GenreId"];
}
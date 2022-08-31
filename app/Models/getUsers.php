<?php

namespace App\Models;

class getUsers extends \CodeIgniter\Model{

    protected $table = "Users";

    protected $allowedFields = ["username", "password"];
}
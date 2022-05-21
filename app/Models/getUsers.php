<?php

namespace App\Models;

class getUsers extends \CodeIgniter\Model{

    protected $table = "Users";

    protected $allowedFields = ["UserName", "Password"];

    protected $validationRules = [
        "UserName" => "required",
        "Password" => "required"
    ];
}
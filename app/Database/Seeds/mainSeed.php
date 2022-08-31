<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class mainSeed extends Seeder
{
    public function run()
    {
        $this->call("Users");
        $this->call("Songs");
        $this->call("Genres");
    }
}
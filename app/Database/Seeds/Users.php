<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class users extends Seeder
{
    public function run()
    {
        $data = [
                    [
                    'username' => 'Airto',
                    'password'    => 'qqaaa'
                    ],
                    [
                        'username' => 'Joran',
                        'password'    => 'abcd'
                    ]
                ];
        foreach($data as $users){
            $this->db->table('users')->insert($users);
        }
    }
}
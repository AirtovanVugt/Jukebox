<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Genres extends Seeder
{
    public function run()
    {
        $data = [
                    [
                        'genre' => 'Rock'
                    ],
                    [
                        'genre' => 'Rap'
                    ],
                    [
                        'genre' => 'Jazz'
                    ],
                    [
                        'genre' => 'Hardcore'
                    ],
                    [
                        'genre' => 'Pop',
                    ]
                ];
        foreach($data as $genre){
            $this->db->table('genres')->insert($genre);
        }
    }
}
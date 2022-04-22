<?php

namespace App\Controllers;

class Home extends BaseController{

    public function index(){
        $model = new \App\Models\getSongs;

        $muziek = $model->where("id", "1")
                        ->first();

        return view('Inloggen.php', ["muziek" => $muziek]);
    }
}

<?php

namespace App\Controllers;

class Home extends BaseController{

    public function index(){
        return view('Inloggen');
    }

    public function createAccount($create){
        return view("inloggen", ["create" => $create]);
    }
}

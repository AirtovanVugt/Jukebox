<?php

namespace App\Controllers;

class Home extends BaseController{

    public function index(){
        return view('Inloggen');
    }

    public function createAccountPage($create){
        return view("inloggen", ["create" => $create]);
    }

    public function inloggen(){

        $model = new \App\Models\getUsers;
        $user = $model->where("UserName", $this->request->getPost("username"))
                      ->where("Password", $this->request->getPost("password"))
                      ->first();
        if($user == null){
            return redirect()->back()
                             ->with("warning", "This user doesn't exist.")
                             ->withInput();
        }
        else{
            session()->set("id", $user["userId"]);
            session()->set("playlist", []);
            return redirect()->to("/playlist");
        }
    }

    public function createAccount(){
        $model = new \App\Models\getUsers;

        $username = $model->where("username", $this->request->getPost("username"))
                          ->first();
        $password = $model->where("password", $this->request->getPost("password"))
                          ->first();


        if($username != NULL || $password != NULL){
            return redirect()->back()
                             ->with("warning", "This username or password is already in use.")
                             ->withInput();
        }
        elseif(empty($this->request->getPost("username")) || empty($this->request->getPost("password"))){
            return redirect()->back()
                             ->with("warning", "Username or password may not stay empty.")
                             ->withInput();
        }
        else{
            $model->insert($this->request->getPost());
            return redirect()->to("/inloggen");
        }
    }

    public function uitloggen(){
        session()->destroy();
        return redirect()->to("/inloggen");
    }
}

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
        $user = $model->where("UserName", $this->request->getPost("UserName"))
                      ->where("Password", $this->request->getPost("Password"))
                      ->first();
        if($user == null){
            return redirect()->back()
                             ->with("warning", "This user doesn't exist.")
                             ->withInput();
        }
        else{
            session()->set("id", $user["UserId"]);
            return redirect()->to("/playlist");
        }
    }

    public function createAccount(){
        $model = new \App\Models\getUsers;

        $username = $model->where("UserName", $this->request->getPost("UserName"))
                          ->first();
        $password = $model->where("Password", $this->request->getPost("Password"))
                          ->first();
        if($password != null && $username != null){
            return redirect()->back()
                             ->with("warning", "This username or password is already in use.")
                             ->withInput();
        }
        elseif(empty($username) || empty($password)){
            return redirect()->back()
                             ->with("warning", "Username or password may not stay empty.")
                             ->withInput();
        }
        else{
            $model->insert($this->request->getPost());
            return redirect()->to("/inloggen");
        }


    }
}

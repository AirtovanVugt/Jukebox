<?php

namespace App\Controllers;

class session extends BaseController{

    public function __construct(){
        helper("rememberUser");
        $this->currentuser = current_user();
    }

    public function setInSession($songId){
        $songmodel = new \App\Models\getSongs;

        session()->push("playlist", [$songId]);

        return redirect()->back();
    }

    public function removeInSession($remove){
        $thearray = session()->get("playlist");
        unset($thearray[$remove]);
        session()->set("playlist", $thearray);
        return redirect()->back();
    }
}
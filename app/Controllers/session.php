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

    public function oneGenre($genreId){
        session()->set("genre", $genreId);
        return redirect()->back();
    }

    public function setInPlaylist(){
        $songmodel = new \App\Models\getSongs;
        $playlistmodel = new \App\Models\getPlaylist;
        $SongsInPlaylist = new \App\Models\getSongsInPlaylist;
        
        $exist = $playlistmodel->where("namePlaylist", $this->request->getPost("namePlaylist"))
                               ->where("userId", $this->currentuser["userId"])
                               ->first();

        if($exist != NULL || empty($this->request->getPost("namePlaylist"))){
            return redirect()->back()
                             ->with("warning", "this name allready exist or this field or playlist is empty.")
                             ->withInput();
        }
        else{
            $playlistmodel->insert(["namePlaylist" => $this->request->getPost("namePlaylist"), "userId" => $this->currentuser["userId"]]);
            $getplaylistId = $playlistmodel->where("namePlaylist", $this->request->getPost("namePlaylist"))
                                           ->first();
            foreach(session()->get("playlist") as $count => $songId){
                $song = $songmodel->where("songId", $songId)
                                   ->first();
                $SongsInPlaylist->insert(["userId" => $this->currentuser["userId"], "songId" => $songId, "playlistId" => $getplaylistId["playlistId"], "nameSong" => $song["nameSong"], "time" => $song["time"]]);
            }   
            session()->remove("playlist");
            session()->set("playlist", []);
            return redirect()->back();
        }
    }
}
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

    public function checkGenre(){
        $songmodel = new \App\Models\getSongs;

        if(session()->get("genre") != NULL && session()->get("genre") >= "1"){
            $songs = $songmodel->where("genreId", session()->get("genre"))
                               ->get()
                               ->getResult();
            return $songs;
        }
        else{
            $songs = $songmodel->get()
                               ->getResult();
            return $songs;
        }
    }

    public function setPlaylistInDatabase($exist, $thePost){
        $songmodel = new \App\Models\getSongs;
        $playlistmodel = new \App\Models\getPlaylist;
        $SongsInPlaylist = new \App\Models\getSongsInPlaylist;

        if($exist != NULL || empty($thePost["namePlaylist"])){
            return redirect()->back()
                             ->with("warning", "this name allready exist or this field or playlist is empty.")
                             ->withInput();
        }
        else{
            $playlistmodel->insert(["namePlaylist" => $thePost["namePlaylist"], "userId" => $this->currentuser["userId"]]);
            $getplaylistId = $playlistmodel->where("namePlaylist", $thePost["namePlaylist"])
                                           ->first();
            foreach(session()->get("playlist") as $count => $songId){
                $song = $songmodel->where("songId", $songId)
                                   ->first();
                $SongsInPlaylist->insert(["userId" => $this->currentuser["userId"], "songId" => $songId, "playlistId" => $getplaylistId["playlistId"], "nameSong" => $song["nameSong"], "time" => $song["time"]]);
            }   
            session()->remove("playlist");
            session()->set("playlist", []);
        }
    }
}
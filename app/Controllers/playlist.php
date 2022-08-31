<?php

namespace App\Controllers;

class playlist extends BaseController{

    public function __construct(){
        helper("rememberUser");
        $this->currentuser = current_user();
    }

    public function Homepage(){
        $songmodel = new \App\Models\getSongs;
        $genremodel = new \App\Models\getGenres;
        $playlistmodel= new \App\Models\getPlaylist;
        $songinplaylistmodel = new \App\Models\getSongsInPlaylist;
    
        if(session()->get("genre") != NULL && session()->get("genre") >= "1"){
            $songs = $songmodel->where("genreId", session()->get("genre"))
                               ->get()
                               ->getResult();
        }
        else{
            $songs = $songmodel->get()
                               ->getResult();
        }


        $genres = $genremodel->get()
                             ->getResult();

        $playlist = $playlistmodel->where("userId", $this->currentuser["userId"])
                                  ->get()
                                  ->getResult();

        $songinplaylist = $songinplaylistmodel->where("userId", $this->currentuser["userId"])
                                              ->get()
                                              ->getResult();

        $theSession = session()->get("playlist");
        if(!empty($theSession)){
            $theMinutes = [];
            $theSecondes = [];
            $data = [];
            foreach($theSession as $count => $songId){
                $song = $songmodel->where("songId", $songId)
                                  ->first();
                $data[$count] = $song["nameSong"];
                $thetime = explode(":", $song["time"]);
                $minutes = $thetime["0"];
                $secondes = $thetime["1"];
                $theMinutes[$count] = $minutes;
                $theSecondes[$count] = $secondes;
            }
            $sessionSongs = array_replace($theSession, $data);
            $minutes = array_sum($theMinutes);
            $secondes = array_sum($theSecondes);
            if($secondes >= 59){
                while($secondes >= 59){
                    $secondes = $secondes-60;
                    $minutes++;
                }
            }
            $sessiontime = ["minutes" => $minutes, "secondes" => $secondes];
        }
        else{
            $sessionSongs = [];
            $sessiontime = ["minutes" => "00", "secondes" => "00"];
        }

        return view("playlist", ["songs" => $songs, "genres" => $genres, "playlist" => $playlist, "songinplaylist" => $songinplaylist, "sessionSongs" => $sessionSongs, "sessiontime" => $sessiontime]);
    }

    public function oneGenre($genreId){
        session()->set("genre", $genreId);
        return redirect()->back();
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

    public function setInPlaylist(){
        $songmodel = new \App\Models\getSongs;
        $playlistmodel = new \App\Models\getPlaylist;
        $SongsInPlaylist = new \App\Models\getSongsInPlaylist;

        $exist = $playlistmodel->where("namePlaylist", $this->request->getPost("namePlaylist"))
                               ->where("userId", $this->currentuser["userId"])
                               ->first();

        if($exist != NULL || empty($this->request->getPost("namePlaylist")) || empty(session()->get("playlist"))){
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

    public function changePlaylistname(){
        $playlistmodel = new \App\Models\getPlaylist;

        $playlist = $playlistmodel->where("namePlaylist", $this->request->getPost("namePlaylist"))
                                  ->where("userId", $this->currentuser["userId"])
                                  ->first();

        if($playlist == NULL){
            $name = $this->request->getPost('namePlaylist');
            $id = $this->request->getPost('playlistId');
            $db = db_connect();
            $sql = "UPDATE `playlists` SET `namePlaylist`= ? WHERE `playlistId` = ?";
            $vals = [$name, $id];
            $db->query($sql, $vals);
            return redirect()->back();
        }
        else{
            return redirect()->back()
                             ->with("warning", "this name allready exist.")
                             ->withInput();
        }
    }

    public function removesongInPlaylist($delete){
        $SongsInPlaylist = new \App\Models\getSongsInPlaylist;
        $SongsInPlaylist->where('songplaylistId', $delete)->delete();
        return redirect()->back();
    }

    public function setsonginPlaylist($playlistId, $songId){
        $songmodel = new \App\Models\getSongs;
        $SongsInPlaylist = new \App\Models\getSongsInPlaylist;

        $song = $songmodel->where("songId", $songId)
                          ->first();

        $SongsInPlaylist->insert(["userId" => $this->currentuser["userId"], "songId" => $songId, "playlistId" => $playlistId, "nameSong" => $song["nameSong"], "time" => $song["time"]]);

        return redirect()->back();
    }

    public function deletePlaylist($delete){
        $playlistmodel = new \App\Models\getPlaylist;
        $SongsInPlaylist = new \App\Models\getSongsInPlaylist;

        $playlistmodel->where('playlistId', $delete)->delete();
        $SongsInPlaylist->where('playlistId', $delete)->delete();

        return redirect()->back();
    }

    public function song($id){
        $songmodel = new \App\Models\getSongs;

        $song = $songmodel->where("songId", $id)
                          ->first();

        return view("lyrics", ["song" => $song]);
    }

    public function uitloggen(){
        session()->destroy();
        return view("inloggen");
    }
}
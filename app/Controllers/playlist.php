<?php

namespace App\Controllers;

class playlist extends BaseController{

    public function __construct(){
        helper("rememberUser");
        $this->currentuser = current_user();
    }

    public function Homepage(){
        helper("sessionPlaylist");
        $songmodel = new \App\Models\getSongs;
        $genremodel = new \App\Models\getGenres;
        $playlistmodel= new \App\Models\getPlaylist;
        $songinplaylistmodel = new \App\Models\getSongsInPlaylist;

        $sessionController = new \App\Controllers\session;

        $songs = $sessionController->checkGanre();

        $genres = $genremodel->get()
                             ->getResult();

        $playlist = $playlistmodel->where("userId", $this->currentuser["userId"])
                                  ->get()
                                  ->getResult();

        $songinplaylist = $songinplaylistmodel->where("userId", $this->currentuser["userId"])
                                              ->get()
                                              ->getResult();

        $sessionPlaylist = sessionPlaylist();
        $sessionSongs = $sessionPlaylist["0"];
        $sessiontime = $sessionPlaylist["1"];

        return view("playlist", ["songs" => $songs, "genres" => $genres, "playlist" => $playlist, "songinplaylist" => $songinplaylist, "sessionSongs" => $sessionSongs, "sessiontime" => $sessiontime]);
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
}
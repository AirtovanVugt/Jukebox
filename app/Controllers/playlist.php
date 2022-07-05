<?php

namespace App\Controllers;

class playlist extends BaseController{

    public function __construct(){
        helper("rememberUser");
    }

    public function Homepage(){
        $songmodel = new \App\Models\getSongs;
        $genremodel = new \App\Models\getGenres;
        $playlistmodel= new \App\Models\getPlaylist;
        $songinplaylistmodel = new \App\Models\getSongsInPlaylist;

        $songs = $songmodel->get()
                           ->getResult();

        $genres = $genremodel->get()
                             ->getResult();

        $playlist = $playlistmodel->where("UserId", current_user()["UserId"])
                                  ->get()
                                  ->getResultArray();

        $songinplaylist = $songinplaylistmodel->where("UserId", current_user()["UserId"])
                                  ->get()
                                  ->getResultArray();

        return view("playlist", ["songs" => $songs, "genres" => $genres, "playlist" => $playlist, "songinplaylist" => $songinplaylist]);
    }

    public function song($id){
        $songmodel = new \App\Models\getSongs;

        $song = $songmodel->where("id", $id)
                          ->first();

        return view("lyrics", ["song" => $song]);
    }

    public function oneGen($genId){
        $songmodel = new \App\Models\getSongs;
        $genremodel = new \App\Models\getGenres;
        $playlistmodel= new \App\Models\getPlaylist;
        $songinplaylistmodel = new \App\Models\getSongsInPlaylist;

        $songs = $songmodel->where("GenreId", $genId)
                           ->get()
                           ->getResult();

        $genres = $genremodel->get()
                             ->getResult();

        $playlist = $playlistmodel->where("UserId", current_user()["UserId"])
                                  ->get()
                                  ->getResultArray();

        $songinplaylist = $songinplaylistmodel->where("UserId", current_user()["UserId"])
                                              ->get()
                                              ->getResultArray();

        return view("playlist", ["songs" => $songs, "genres" => $genres, "playlist" => $playlist, "songinplaylist" => $songinplaylist]);
    }

    public function createplaylist(){
        $playlistmodel = new \App\Models\getplaylist;

        $check = $playlistmodel->where("namePlaylist", $this->request->getPost("namePlaylist"))
                      ->first();
        if($check == null && !empty($this->request->getPost("namePlaylist"))){
            $playlistmodel->insert($this->request->getPost());
            return redirect()->back();
        }
        else{
            return redirect()->back()
                             ->with("warning", "This playlistname is allready in use or fill something in.")
                             ->withInput();
        }
    }

    public function setInPlaylist($id){
        $songmodel = new \App\Models\getSongs;
        $playlistmodel= new \App\Models\getPlaylist;

        $song = $songmodel->where("id", $id)
                          ->first();

        $playlist = $playlistmodel->where("UserId", current_user()["UserId"])
                                  ->get()
                                  ->getResultArray();

        return view("setInPlaylist", ["songs" => $song, "playlist" => $playlist]);
    }

    public function setSongInPlaylist(){
        $playlistmodel = new \App\Models\getSongsInPlaylist;
        $theArray = $this->request->getPost();
        for($i=0; $i<=count($theArray)-3; $i++){
            if($theArray["playlist$i"] != 0){
                $check = $playlistmodel->where("playlistId", $theArray["playlist$i"])
                                       ->where("songId", $this->request->getPost("songId"))
                                       ->first();

                if($check == NULL){
                    $anArray = ["playlistId" => $theArray["playlist$i"], "UserId" => $this->request->getPost("UserId"), "songId" => $this->request->getPost("songId")];
                    $playlistmodel->insert($anArray);
                }
            }
        }
        return redirect()->back();
    }

    public function deleteSong($delete){
        var_dump($delete);
        $songinplaylistmodel = new \App\Models\getSongsInPlaylist;
        $songinplaylistmodel->where('songPlaylistId', $delete)->delete();
        return redirect()->back();
    }

    public function uitloggen(){
        session()->destroy();
        return view("inloggen");
    }
}
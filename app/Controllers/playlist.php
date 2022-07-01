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

        $songs = $songmodel->get()
                           ->getResult();

        $genres = $genremodel->get()
                             ->getResult();

        $playlist = $playlistmodel->where("UserId", current_user()["UserId"])
                                  ->get()
                                  ->getResultArray();

        return view("playlist", ["songs" => $songs, "genres" => $genres, "playlist" => $playlist]);
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

        $songs = $songmodel->where("GenreId", $genId)
                           ->get()
                           ->getResult();

        $genres = $genremodel->get()
                             ->getResult();

        $playlist = $playlistmodel->where("UserId", current_user()["UserId"])
                                  ->get()
                                  ->getResultArray();

        return view("playlist", ["songs" => $songs, "genres" => $genres, "playlist" => $playlist]);
    }

    public function createplaylist(){
        $playlistmodel = new \App\Models\getplaylist;
        $playlistmodel->insert($this->request->getPost());
        return redirect()->back();
    }

    public function uitloggen(){
        session()->destroy();
        return view("inloggen");
    }
}
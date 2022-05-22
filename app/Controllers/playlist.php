<?php

namespace App\Controllers;

class playlist extends BaseController{

    public function __construct(){
        helper("rememberUser");
    }

    public function Homepage(){
        $songmodel = new \App\Models\getSongs;
        $genremodel = new \App\Models\getGenres;

        $songs = $songmodel->get()
                           ->getResult();

        $genres = $genremodel->get()
                            ->getResult();

        return view("playlist", ["songs" => $songs, "genres" => $genres]);
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

        $songs = $songmodel->where("GenreId", $genId)
                           ->get()
                           ->getResult();

        $genres = $genremodel->get()
                             ->getResult();

        return view("playlist", ["songs" => $songs, "genres" => $genres]);
    }

    public function uitloggen(){
        session()->destroy();
        return view("inloggen");
    }
}
<?php

function sessionPlaylist(){
    $theSession = session()->get("playlist");
    if(!empty($theSession)){
        $songmodel = new \App\Models\getSongs;
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
        return [$sessionSongs, $sessiontime];
    }
    else{
        $sessionSongs = [];
        $sessiontime = ["minutes" => "00", "secondes" => "00"];
        return [$sessionSongs, $sessiontime];
    }
}

<?php

    function current_user(){
        $model = new \App\Models\getUsers;

        return $model->where("UserId", session()->get("id"))
                     ->first();
    }
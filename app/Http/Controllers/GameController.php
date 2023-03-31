<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{

    public function choices()
    {
        $choices = [
            [
                "nombre" => "piedra",
                "gana" => "tijeras",
                "pierde" => "papel"
            ],
            [
                "nombre" => "papel",
                "gana" => "piedra",
                "pierde" => "tijeras"
            ],
            [
                "nombre" => "tijeras",
                "gana" => "papel",
                "pierde" => "piedra"
            ],
        ];

        return $choices;
    }
}

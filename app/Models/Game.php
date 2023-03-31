<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public $players = [];
    public $choices = [
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
    public array $historical;


    public function randomChoice()
    {
    }

    public function newGame()
    {
    }

    public function getHistorical()
    {
    }

    public function reset()
    {
    }
}

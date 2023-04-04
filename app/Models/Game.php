<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\Cache;

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
    public $historical = [];


    public function computerSelection()
    {
        $arrLength = count($this->choices) - 1;
        $computerSelection = $this->choices[random_int(0, $arrLength)]["nombre"];
        return $computerSelection;
    }

    public function newGame()
    {
    }

    public function getHistorical()
    {   

        $historical = Cache::get("historical");
        $computerSelection = $this->computerSelection();

        $json = json_encode($historical);
        $json = json_decode($json, true);

        $turn = end($json["historical"]);
        $turn["computer"] = $computerSelection;
        $json["historical"] = $turn;
        $historical = $json;

        return json_encode($historical);
    }

    public function reset()
    {
    }
}

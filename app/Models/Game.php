<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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


    public function computerSelection()
    {
        $arrLength = count($this->choices) - 1;
        $computerSelection = $this->choices[random_int(0, $arrLength)]["nombre"];
        return $computerSelection;
    }

    public function computeResult($player, $computer)
    {
        foreach ($this->choices as $key => $choice) {
            if ($choice["nombre"] === $player) {

                if ($choice["gana"] === $computer) {
                    $result = "Victoria";
                } else if ($choice["pierde"] === $computer) {
                    $result = "Derrota";
                } else {
                    $result = "Empate";
                }
            }
        }
        return $result;
    }

    public function getHistorical()
    {

        $historical = Cache::get("historical");
        $computerSelection = $this->computerSelection();

        $json = json_encode($historical);
        $json = json_decode($json, true);

        $turn = end($json["historical"]);
        $player = $turn["player"];
        $turn["computer"] = $computerSelection;

        $json["historical"] = $turn;
        $historical = $json;

        error_log(json_encode($player));

        return json_encode($historical);
    }

    public function reset()
    {
    }
}

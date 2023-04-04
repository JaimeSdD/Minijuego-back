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
                    $result = "victoria";
                } else if ($choice["pierde"] === $computer) {
                    $result = "derrota";
                } else {
                    $result = "empate";
                }
            }
        }
        return $result;
    }

    public function getHistorical()
    {

        $historical = Cache::get("historical");
        $computer = $this->computerSelection();

        $json = json_encode($historical);
        $json = json_decode($json, true);

        $turn = end($json["historical"]);
        $player = $turn["player"];
        $turn["computer"] = $computer;

        $result = $this -> computeResult($player, $computer);
        $turn["result"] = $result;

        $json["historical"] = $turn;
        $historical = $json;

        return json_encode($historical);
    }

    public function reset()
    {
    }
}

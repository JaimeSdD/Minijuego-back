<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
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

    public function getTurn($historical, $computer)
    {   
        $turn = end($historical);
        $turn["computer"] = $computer;
        $player = $turn["player"];
        $result = $this->computeResult($player, $computer);
        $turn["result"] = $result;
        return $turn;
    }
    
    public function updateHistorical($historical, $turn)
    {
        $arrLength = count($historical) - 1;
        $historical[$arrLength] = $turn;
        
        if (count($historical) === 11) {
            array_shift($historical);
        }
        return $historical;
    }

    public function setHistorical(Request $request)
    {

        $historical = $request->input("historical");
        $computer = (new Game)->computerSelection();

        $turn = $this->getTurn($historical, $computer);
        $historical = $this->updateHistorical($historical, $turn);

        Cache::put("historical", $historical);

        return response()->json($historical);
    }

    public function getHistorical()
    {
        if (Cache::has("historical")) {
            $historical = Cache::get("historical");

            return response()->json($historical);
        }
        return response() -> json([]);
    }
}

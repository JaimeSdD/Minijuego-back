<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GameController extends Controller
{
    
    public function setData(Request $request)
    {
        $historical = $request -> all();
        $computer = (new Game)->computerSelection();
        
        $json = json_encode($historical);
        $json = json_decode($json, true);
        
        $turn = end($json["historical"]);
        $turn["computer"] = $computer;
        
        $arrLength = count($json["historical"]) - 1;      
        $json["historical"][$arrLength] = $turn;
        $historical = $json;     

        Cache::put("historical", $historical);

        return response() -> json($historical);
     
    }
    

    public function getData()
    {
        $historical = (new Game) -> getHistorical();

        return $historical;
    }

    public function deleteData()
    {
        Cache::forget("historical");

        return response() -> json("Historial borrado");

    }
}
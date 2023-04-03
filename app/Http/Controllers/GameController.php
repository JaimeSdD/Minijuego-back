<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GameController extends Controller
{
    
    public function setData(Request $request)
    {
        $computerSelection = (new Game)->computerSelection();
        
        $json = json_encode($request->all());
        $json = json_decode($json, true);
        
        $turn = end($json["historical"]);
        $turn["computer"] = $computerSelection;
        $json["historical"] = $turn;
        $historical = $json;
        json_encode($historical);

        Cache::put("historical", $historical);

        return json_encode($historical);
    }
    

    public function test()
    {
        $historical = Cache::get("historical");
     
        return $historical;
    }
}
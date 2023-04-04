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

        Cache::put("historical", $historical);

        return response() -> json($historical);
     
    }
    

    public function test()
    {
        $historical = (new Game) -> getHistorical();

        return $historical;
    }
}
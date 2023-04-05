<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class GameController extends Controller
{
    
    public function setData(Request $request)
    {

        $historical = (new Game) -> setHistorical($request);

        return $historical;
     
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
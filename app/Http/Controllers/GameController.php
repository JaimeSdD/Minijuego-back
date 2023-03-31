<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function choices()
    {
        $game = new Game();
        return $game ->choices;
    }
}

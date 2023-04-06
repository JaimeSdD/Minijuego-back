<?php

namespace Tests\Unit;

use App\Models\Game;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    public function testComputerSelection()
    {
        $game = new Game();
        $selection = $game->computerSelection();
        $selection1 = $game->computerSelection();
        $this->assertContains($selection, array_column($game ->choices, 'nombre'), "No existe la selección con ese nombre");
        $this->assertContains($selection1, array_column($game ->choices, 'nombre'), "No existe la selección con ese nombre");
    }
}

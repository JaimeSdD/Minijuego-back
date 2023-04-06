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
        $selection2 = $game->computerSelection();

        $this->assertContains($selection, array_column($game ->choices, "nombre"));
        $this->assertContains($selection1, array_column($game ->choices, "nombre"));
        $this->assertContains($selection2, array_column($game ->choices, "nombre"));
    }

    public function testComputeResult()
    {
        $game = new Game();

        $this->assertEquals("victoria", $game->computeResult("piedra", "tijeras"));
        $this->assertEquals("victoria", $game->computeResult("papel", "piedra"));
        $this->assertEquals("victoria", $game->computeResult("tijeras", "papel"));

        $this->assertEquals("derrota", $game->computeResult("piedra", "papel"));
        $this->assertEquals("derrota", $game->computeResult("papel", "tijeras"));
        $this->assertEquals("derrota", $game->computeResult("tijeras", "piedra"));

        $this->assertEquals("empate", $game->computeResult("piedra", "piedra"));
        $this->assertEquals("empate", $game->computeResult("papel", "papel"));
        $this->assertEquals("empate", $game->computeResult("tijeras", "tijeras"));
    }
}

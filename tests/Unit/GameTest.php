<?php

namespace Tests\Unit;

use App\Models\Game;
use Illuminate\Http\Request;
use Mockery;
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

    public function testGetTurn()
    {
        $game = new Game();

        $historical = [
            ["player" => "papel", "computer" => "piedra", "result" => "ganar"], ["player" => "tijeras"],
        ];
        $computer = "piedra";

        $result = $game->getTurn($historical, $computer);

        $this->assertEquals($computer, $result["computer"]);
        $this->assertEquals("tijeras", $result["player"]);
        $this->assertEquals("derrota", $result["result"]);

    }
    public function testUpdateHistorical()
    {
        $game = new Game();

        $historical = [
            ["player" => "piedra", "computer" => "tijeras", "result" => "victoria"],
            ["player" => "piedra", "computer" => "tijeras", "result" => "victoria"],
            ["player" => "piedra", "computer" => "tijeras", "result" => "victoria"],
            ["player" => "piedra", "computer" => "tijeras", "result" => "victoria"],
            ["player" => "piedra", "computer" => "tijeras", "result" => "victoria"],
            ["player" => "piedra", "computer" => "tijeras", "result" => "victoria"],
            ["player" => "piedra", "computer" => "tijeras", "result" => "victoria"],
            ["player" => "piedra", "computer" => "tijeras", "result" => "victoria"],
            ["player" => "piedra", "computer" => "tijeras", "result" => "victoria"],
            ["player" => "piedra", "computer" => "tijeras", "result" => "victoria"],
        ];
        $turn = ["player" => "tijeras", "computer" => "papel", "result" => "victoria"];

        $result = $game->updateHistorical($historical, $turn);

        $this->assertCount(10, $result);
        $this->assertEquals($turn, $result[count($historical) - 1]);
    }
}

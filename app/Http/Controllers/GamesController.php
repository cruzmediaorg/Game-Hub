<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GamesController extends Controller
{
    public function show(Game $game)
    {
        return Inertia::render('Games/TicTacToe');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Actions\CreateGameRoom;

class GamesController extends Controller
{
    public function show(Game $game)
    {
        return Inertia::render('Games/Lobby', [
            'game' => $game,
            'rooms' => $game->nonExpiredGameRooms->load('playerOne'),
        ]);
    }

    public function store(Game $game)
    {
        if ($game->nonExpiredGameRooms()->where('player_one_id', auth()->user()->id)->exists()) {
            return redirect()->back()->with('error', 'You already have an active game room.');
        }

        $game = CreateGameRoom::handle($game, auth()->user());

       return redirect()->back();
    }
}
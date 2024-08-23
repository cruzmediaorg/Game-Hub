<?php

namespace App\Http\Controllers;

use App\Models\GameRoom;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GamesRoomController extends Controller
{
    public function show(GameRoom $room)
    {
        return Inertia::render($room->game->path, [
            'room' => $room,
        ]);
    }

    public function join(GameRoom $room)
    {
        $room->update([
            'player_two_id' => auth()->user()->id,
            'game_started_at' => now(),
        ]);

        return redirect()->to(route('games.room.show', $room->id));
    }
}

<?php

namespace App\Actions;

use App\Models\Game;
use App\Models\GameRoom;
use App\Models\User;

class CreateGameRoom
{
  
    public static function handle(Game $game, User $user): GameRoom
    {
        return $game->gameRooms()->create([
            'player_one_id' => $user->id,
        ]);
    }
}

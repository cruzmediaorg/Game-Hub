<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameRoom extends Model
{
    use HasFactory;

    protected $fillable = ['player_one_id', 'player_two_id', 'game_id', 'game_started_at', 'game_ended_at'];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function playerOne()
    {
        return $this->belongsTo(User::class, 'player_one_id');
    }

    public function playerTwo()
    {
        return $this->belongsTo(User::class, 'player_two_id');
    }
}

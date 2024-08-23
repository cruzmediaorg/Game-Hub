<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Game extends Model
{

    protected $guarded = [];

    /**
     * Get the route key name.
     * Instead of ID, we're using the slug as "Route Model Binding"
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Get the game rooms.
     *
     * @return HasMany
     */
    public function gameRooms()
    {
        return $this->hasMany(GameRoom::class);
    }

    /**
     * Get the player one.
     *
     * @return HasOne
     */
    public function playerOne()
    {
        return $this->hasOne(User::class, 'id', 'player_one_id');
    }

    /**
     * Get the player two.
     *
     * @return HasOne
     */
    public function playerTwo()
    {
        return $this->hasOne(User::class, 'id', 'player_two_id');
    }

    /**
     * Get the non-expired game rooms.
     *
     * @return HasMany
     */
    public function nonExpiredGameRooms(): HasMany
    {
        return $this->hasMany(GameRoom::class)
            ->whereNull('player_two_id')
            ->whereNull('game_started_at')
            ->whereNull('game_ended_at')
            ->where('created_at', '>=', now()->subMinutes(10));
    }
}
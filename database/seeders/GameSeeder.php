<?php

namespace Database\Seeders;

use App\Models\Game;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Game::updateOrCreate([
            'name' => 'Tic Tac Toe',
            'slug' => 'tic-tac-toe',
        ], [
            'path' => 'Games/TicTacToe',
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Puzzle;
use App\Models\User;

class PuzzleSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            Puzzle::factory(1)->create(['user_id' => $user->id]);
        }
    }
}

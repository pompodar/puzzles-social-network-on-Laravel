<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function showPuzzles($userId)
    {
        $user = User::findOrFail($userId);
        $puzzles = $user->puzzles;

        return view('user.puzzles', compact('user', 'puzzles'));
    }
}

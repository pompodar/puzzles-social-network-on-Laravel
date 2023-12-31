<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
     public function index()
    {
        // Retrieve users with the number of correct comments they made
        $users = User::withCount('correctComments', 'incorrectComments', 'allComments')->orderByDesc('correct_comments_count')->paginate(5);

        return view('users.index', compact('users'));
    }
    
    public function showPuzzles($userId)
    {
        $user = User::findOrFail($userId);
        $puzzles = $user->puzzles;

        return view('user.puzzles', compact('user', 'puzzles'));
    }
}

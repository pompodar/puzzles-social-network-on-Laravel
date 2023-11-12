<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $puzzles = Puzzle::where('approved', true)->paginate(2); 

        return view('pages.home', ['puzzles' => $puzzles]);
    }

    public function like($puzzleId)
    {
        $user = Auth::user();
        $puzzle = Puzzle::findOrFail($puzzleId);

        if (!$user->likes()->where('puzzle_id', $puzzle->id)->exists()) {
            $like = new Like();
            $like->user_id = $user->id;
            $like->puzzle_id = $puzzle->id;
            $like->save();

            return 'success';
        }
    }

    public function dislike($puzzleId)
    {
        $user = Auth::user();
        $puzzle = Puzzle::findOrFail($puzzleId);

        $like = $user->likes()->where('puzzle_id', $puzzle->id)->first();

        if ($like) {
            $like->delete();

            return 'success';
        }
    }
}
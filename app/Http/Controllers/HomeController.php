<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Paginate puzzles
        $puzzles = Puzzle::where('approved', true)->paginate(3);

        // Retrieve comments for each puzzle
        foreach ($puzzles as $puzzle) {
            $puzzle->comments = Comment::where('puzzle_id', $puzzle->id)->get();
        }

        return view('pages.home', ['puzzles' => $puzzles]);
    }

    public function addComment(Request $request, $puzzleId)
    {
        // Validation logic as needed
        $request->validate([
            'content' => 'required|max:255',
        ]);

        // Create the comment
        $comment = new Comment();
        $comment->user_id = auth()->id();
        $comment->puzzle_id = $puzzleId;
        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('puzzle.show', ['puzzleId' => $puzzleId])->with('success', 'Comment added successfully.');
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
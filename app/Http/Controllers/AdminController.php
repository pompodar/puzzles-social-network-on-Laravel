<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {        
        $puzzlesToApprove = Puzzle::where('approved', false)->paginate(1);

        return view('admin.puzzles.index', ['puzzlesToApprove' => $puzzlesToApprove]);
    }

    public function approve($id)
    {
        $puzzle = Puzzle::findOrFail($id);
        $puzzle->approved = true;
        $puzzle->save();

        return redirect()->route('admin.puzzles.index')->with('success', 'Puzzle approved successfully.');
    }

    public function delete($id)
    {
        $puzzle = Puzzle::findOrFail($id);
        $puzzle->delete();

        return redirect()->back()->with('success', 'Puzzle deleted successfully.');
    }

    public function reviewComments()
    {
        // Fetch puzzles that have unchecked comments
        $puzzlesWithUncheckedComments = Puzzle::whereHas('comments', function ($query) {
            $query->where('is_correct', 0);
        })->get();

        return view('admin.comments.review', ['puzzlesWithUncheckedComments' => $puzzlesWithUncheckedComments]);
    }

    public function markCommentAsCorrect($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        
        // Check if the user is an admin (you need to implement your own logic for this)
        if (auth()->user()->isAdmin()) {
            $comment->is_correct = 1;
            $comment->save();

            return redirect()->back()->with('success', 'Comment marked as correct.');
        }

        return redirect()->back()->with('error', 'Permission denied.');
    }

    public function markCommentAsIncorrect($commentId)
    {
        $comment = Comment::findOrFail($commentId);
        
        // Check if the user is an admin (you need to implement your own logic for this)
        if (auth()->user()->isAdmin()) {
            $comment->is_correct = -1;
            $comment->save();

            return redirect()->back()->with('success', 'Comment marked as incorrect.');
        }

        return redirect()->back()->with('error', 'Permission denied.');
    }

    public function reviewPuzzles()
    {
        // Fetch puzzles that have unchecked comments
        $puzzles = Puzzle::paginate(1);

        return view('admin.puzzles.review', ['puzzles' => $puzzles]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puzzle;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;

class PuzzleController extends Controller
{
    public function create()
    {
        return view('puzzles.create');
    }

    public function show($puzzleId)
    {
        $puzzle = Puzzle::findOrFail($puzzleId);
        // Assuming you have a relationship to get comments
        $comments = $puzzle->comments()->with('user')->get();

        return view('puzzles.show', compact('puzzle', 'comments'));
    }

    public function store(Request $request)
    {
        // Validation rules, adjust as needed
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        // Create a new puzzle and associate it with the authenticated user
        $user = Auth::user();
        $puzzle = $user->puzzles()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            // Add other fields as needed
        ]);

        // Associate tags with the puzzle
        $tags = $request->input('tags', '');
        $tagArray = is_string($tags) ? explode(', ', $tags) : [];

        $tagIds = [];

        foreach ($tagArray as $tagName) {
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $tagIds[] = $tag->id;
        }

        $puzzle->tags()->sync($tagIds);

        return redirect()->route('home')->with('success', 'Puzzle created successfully!');
    }
}


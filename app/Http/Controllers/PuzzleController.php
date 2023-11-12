<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Puzzle;

class PuzzleController extends Controller
{
    public function create()
    {
        return view('puzzles.create');
    }

    public function store(Request $request)
    {
        // Validation rules, adjust as needed
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        // Create a new puzzle
        Puzzle::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('home')->with('success', 'Puzzle created successfully!');
    }
}


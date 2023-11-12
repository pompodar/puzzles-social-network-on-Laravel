<?php

namespace App\Http\Controllers;

use App\Models\Puzzle;
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

        return redirect()->route('admin.puzzles.index')->with('success', 'Puzzle deleted successfully.');
    }
}

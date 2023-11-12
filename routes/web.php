<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Puzzle;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PuzzleController;

// Route::get('/', function () {
//     $puzzles = Puzzle::all(); 
//     return view('pages.home', ['puzzles' => $puzzles]);
// })->name('home');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/puzzle/{id}/like', [HomeController::class, 'like'])->name('puzzle.like');
Route::get('/puzzle/{id}/dislike', [HomeController::class, 'dislike'])->name('puzzle.dislike');

Route::get('/puzzle/create', [PuzzleController::class, 'create'])->name('puzzle.create');
Route::post('/puzzle', [PuzzleController::class, 'store'])->name('puzzle.store');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/user/{userId}', [UserController::class, 'showPuzzles'])->name('user.puzzles');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

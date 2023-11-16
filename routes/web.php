<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Puzzle;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PuzzleController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/rules', function () {
    return view('pages.rules');
})->name('rules');

Route::get('/puzzle/{id}/like', [HomeController::class, 'like'])->name('puzzle.like');
Route::get('/puzzle/{id}/dislike', [HomeController::class, 'dislike'])->name('puzzle.dislike');

Route::get('/puzzle/create', [PuzzleController::class, 'create'])->name('puzzle.create');
Route::post('/puzzle', [PuzzleController::class, 'store'])->name('puzzle.store');

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/user/{userId}', [UserController::class, 'showPuzzles'])->name('user.puzzles');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/puzzles', [AdminController::class, 'index'])->name('admin.puzzles.index');
    Route::post('/admin/puzzles/approve/{id}', [AdminController::class, 'approve'])->name('admin.puzzles.approve');
    Route::delete('/admin/puzzles/delete/{id}', [AdminController::class, 'delete'])->name('admin.puzzles.delete');
    
    Route::get('/admin/comments', [AdminController::class, 'reviewComments'])->name('admin.comments.review');
    Route::post('/admin/comments/{commentId}/mark-as-correct', [AdminController::class, 'markCommentAsCorrect'])
    ->name('admin.comments.markAsCorrect');
    Route::post('/admin/comments/{commentId}/mark-as-incorrect', [AdminController::class, 'markCommentAsInCorrect'])
    ->name('admin.comments.markAsInCorrect');
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');

Route::get('/puzzles/{puzzleId}', [PuzzleController::class, 'show'])->name('puzzle.show');
Route::post('/puzzles/{puzzleId}/add-comment', [HomeController::class, 'addComment'])->name('puzzle.addComment');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Define relationships
    public function puzzles()
    {
        return $this->hasMany(Puzzle::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function allComments()
    {
        return $this->comments();
    }

    public function correctComments()
    {
        return $this->comments()->where('is_correct', '1');
    }

    public function incorrectComments()
    {
        return $this->comments()->where('is_correct', '-1');
    }

    public function isAdmin()
    {
        // Implement your logic to check if the user is an admin
        return $this->admin == 1; 
    }
}

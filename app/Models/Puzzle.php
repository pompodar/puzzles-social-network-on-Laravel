<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Puzzle extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'description', 'correct_answer', 'approved']; 

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    protected $appends = ['likes_count'];

    public function getLikesCountAttribute()
    {
        return $this->likes()->count();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}

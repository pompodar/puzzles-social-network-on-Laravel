<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'puzzle_id', 'content', 'is_correct'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function puzzle()
    {
        return $this->belongsTo(Puzzle::class);
    }
}

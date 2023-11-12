<?php

namespace Database\Factories;

use App\Models\Puzzle;
use Illuminate\Database\Eloquent\Factories\Factory;

class PuzzleFactory extends Factory
{
    protected $model = Puzzle::class;

    public function definition()
    {
        return [
            'user_id' => 1, 
            'title' => 'Пожежа в лісі',
            'description' => 'У лісі займається вогонь. З кожним днем він охоплює вдвічі більшу площу лісу. Врешті, на 40-вий день, ліс повністю в огні. Котрого дня ліс охоплений наполовину?',
            'approved' => true,
        ];
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuzzlesTable extends Migration
{
    public function up()
    {
        Schema::create('puzzles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(); // Add the 'user_id' field as a foreign key
            $table->string('title');
            $table->text('description');
            $table->boolean('approved')->default(false); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('puzzles');
    }
}

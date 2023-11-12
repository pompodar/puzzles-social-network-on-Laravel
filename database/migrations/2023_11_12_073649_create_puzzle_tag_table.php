<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuzzleTagTable extends Migration
{
    public function up()
    {
        Schema::create('puzzle_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('puzzle_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('puzzle_id')->references('id')->on('puzzles')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('puzzle_tag');
    }
}

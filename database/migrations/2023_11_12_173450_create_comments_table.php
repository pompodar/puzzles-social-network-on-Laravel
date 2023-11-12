<?php
// Example: database/migrations/yyyy_mm_dd_HHMMSS_create_comments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('puzzle_id');
            $table->text('content');
            $table->tinyInteger('is_correct')->nullable()->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('puzzle_id')->references('id')->on('puzzles')->onDelete('cascade');

            // Add a unique constraint to ensure a user can only comment once on a puzzle
            $table->unique(['user_id', 'puzzle_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('comments');
    }
}

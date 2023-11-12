<?php
// database/migrations/yyyy_mm_dd_HHMMSS_drop_comments_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class DropCommentsTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('comments');
    }

    public function down()
    {
        // If needed, you can recreate the 'comments' table in the down method
        // Schema::create('comments', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('user_id');
        //     $table->unsignedBigInteger('puzzle_id');
        //     $table->text('content');
        //     $table->boolean('is_correct')->nullable()->default(null);
        //     $table->timestamps();
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->foreign('puzzle_id')->references('id')->on('puzzles')->onDelete('cascade');
        //     $table->unique(['user_id', 'puzzle_id']);
        // });
    }
}

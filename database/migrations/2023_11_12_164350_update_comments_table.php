<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCommentsTable extends Migration
{
    public function up()
    {
        // Rename the 'correct' column to 'is_correct' and change its default value to null
        Schema::table('comments', function (Blueprint $table) {
            $table->renameColumn('correct', 'is_correct')->nullable()->default(null);
        });
    }

    public function down()
    {
        // Reverse the changes if needed
        Schema::table('comments', function (Blueprint $table) {
            $table->renameColumn('is_correct', 'correct')->default(false)->change();
        });
    }
}

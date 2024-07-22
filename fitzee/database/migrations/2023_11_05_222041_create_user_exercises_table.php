<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_exercises', function (Blueprint $table) {
            $table->foreignUuid('user_id')->constrained('users');
            $table->foreignUuid('exercise_id')->constrained('exercises');

            $table->timestamps();

            $table->primary(['user_id', 'exercise_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_exercises');
    }
};

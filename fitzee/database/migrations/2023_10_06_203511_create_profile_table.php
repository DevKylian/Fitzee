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
        Schema::create('profile', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('user_id')->nullable()->constrained('users');

            $table->bigInteger('gender')->nullable();
            $table->bigInteger('goal')->nullable();
            $table->date('goal_date')->nullable();
            $table->bigInteger('age')->nullable();
            $table->bigInteger('weight')->nullable();
            $table->bigInteger('weight_goal')->nullable();
            $table->bigInteger('size')->nullable();
            $table->bigInteger('program_type')->nullable();
            $table->bigInteger('gym_frequentation')->nullable();
            $table->bigInteger('gym_experience')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};

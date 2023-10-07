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

            $table->bigInteger('goal');
            $table->bigInteger('age');
            $table->bigInteger('weight');
            $table->bigInteger('size');
            $table->bigInteger('gym_frequentation');
            $table->bigInteger('gym_experience');

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

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
        Schema::create('exercises', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('muscle_id')->nullable()->constrained('muscles');

            $table->string('name');
            $table->string('slug');
            $table->string('img');
            $table->string('tutorial');

            $table->integer('priority');
            $table->boolean('machine');
            $table->string('type');
            $table->string('difficulty');
            $table->boolean('polyarticular');
            $table->integer('muscle_part');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercise');
    }
};

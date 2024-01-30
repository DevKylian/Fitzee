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
        Schema::create('reps', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->foreignUuid('serie_id')->nullable()->constrained('series')->onDelete('cascade');

            $table->integer('reps');
            $table->integer('weight');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reps');
    }
};

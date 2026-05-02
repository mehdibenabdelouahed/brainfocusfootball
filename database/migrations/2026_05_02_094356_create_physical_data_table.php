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
        Schema::create('physical_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained()->cascadeOnDelete();
            $table->timestamp('recorded_at')->nullable();
            $table->decimal('speed_max_kmh', 5, 2)->nullable();
            $table->decimal('distance_km', 5, 2)->nullable();
            $table->integer('sprint_count')->nullable();
            $table->integer('heart_rate_avg')->nullable();
            $table->decimal('vo2_max', 5, 2)->nullable();
            $table->string('recorded_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_data');
    }
};

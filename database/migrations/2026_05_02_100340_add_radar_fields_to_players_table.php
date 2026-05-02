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
        Schema::table('players', function (Blueprint $table) {
            $table->integer('jersey_number')->nullable();
            $table->integer('radar_mental')->nullable();
            $table->integer('radar_physique')->nullable();
            $table->integer('radar_technique')->nullable();
            $table->integer('radar_vitesse')->nullable();
            $table->integer('radar_vision')->nullable();
            $table->integer('radar_social')->nullable();
            $table->integer('matches_played')->nullable();
            $table->integer('goals_scored')->nullable();
            $table->integer('assists')->nullable();
            $table->string('season')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('players', function (Blueprint $table) {
            //
        });
    }
};

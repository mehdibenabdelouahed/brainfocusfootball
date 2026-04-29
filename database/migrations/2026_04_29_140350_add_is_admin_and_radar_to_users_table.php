<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Admin flag
            $table->boolean('is_admin')->default(false)->after('profile_completed');

            // Radar de performance (note 1-10)
            $table->unsignedTinyInteger('radar_mental')->default(5)->after('is_admin');
            $table->unsignedTinyInteger('radar_physique')->default(5)->after('radar_mental');
            $table->unsignedTinyInteger('radar_technique')->default(5)->after('radar_physique');
            $table->unsignedTinyInteger('radar_vitesse')->default(5)->after('radar_technique');
            $table->unsignedTinyInteger('radar_vision')->default(5)->after('radar_vitesse');
            $table->unsignedTinyInteger('radar_social')->default(5)->after('radar_vision');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'is_admin',
                'radar_mental', 'radar_physique', 'radar_technique',
                'radar_vitesse', 'radar_vision', 'radar_social',
            ]);
        });
    }
};

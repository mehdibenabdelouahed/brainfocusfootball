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
        Schema::table('users', function (Blueprint $table) {
            // Informations personnelles
            $table->string('first_name')->nullable()->after('name');
            $table->string('last_name')->nullable()->after('first_name');
            $table->date('date_of_birth')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('phone')->nullable();
            
            // Informations sportives
            $table->string('position')->nullable(); // Poste (ex: Ailier droit, Meneur de jeu)
            $table->enum('preferred_foot', ['Droit', 'Gauche', 'Ambidextre'])->nullable();
            $table->integer('height')->nullable(); // Taille en cm
            $table->integer('weight')->nullable(); // Poids en kg
            $table->string('current_club')->nullable();
            $table->string('level')->nullable(); // Ex: U19 Élite, Senior Amateur
            $table->integer('jersey_number')->nullable();
            
            // Médias
            $table->string('main_video_url')->nullable();
            $table->json('secondary_videos')->nullable(); // Array d'URLs
            $table->json('photos')->nullable(); // Array d'URLs
            
            // Profil
            $table->text('bio')->nullable();
            $table->json('goals')->nullable(); // Objectifs du joueur
            $table->json('achievements')->nullable(); // Réalisations
            
            // Statistiques
            $table->integer('matches_played')->default(0);
            $table->integer('goals_scored')->default(0);
            $table->integer('assists')->default(0);
            $table->string('season')->nullable(); // Ex: 2024/25
            
            // Réseaux sociaux
            $table->string('instagram_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('youtube_url')->nullable();
            
            // Métadonnées
            $table->boolean('profile_completed')->default(false);
            $table->boolean('is_public')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name', 'last_name', 'date_of_birth', 'profile_photo', 'phone',
                'position', 'preferred_foot', 'height', 'weight', 'current_club', 'level', 'jersey_number',
                'main_video_url', 'secondary_videos', 'photos',
                'bio', 'goals', 'achievements',
                'matches_played', 'goals_scored', 'assists', 'season',
                'instagram_url', 'tiktok_url', 'youtube_url',
                'profile_completed', 'is_public'
            ]);
        });
    }
};

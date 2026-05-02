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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('guardian_id')->nullable(); // Can't constrain yet, table might be created later or we do it carefully. Let's just create foreignId.
            $table->date('date_of_birth')->nullable();
            $table->string('nationality')->nullable();
            $table->string('position')->nullable();
            $table->enum('dominant_foot', ['Droit', 'Gauche', 'Ambidextre'])->nullable();
            $table->integer('height_cm')->nullable();
            $table->integer('weight_kg')->nullable();
            $table->string('current_club')->nullable();
            $table->date('contract_until')->nullable();
            $table->decimal('market_value', 12, 2)->nullable();
            $table->string('visibility')->default('public');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};

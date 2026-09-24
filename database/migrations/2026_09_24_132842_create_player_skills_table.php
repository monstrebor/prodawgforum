<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_skills', function (Blueprint $table) {
            $table->id();

            // Player who owns the skill
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Skill that was unlocked
            $table->foreignId('skill_id')
                ->constrained('skills')
                ->cascadeOnDelete();

            // Skill level
            $table->unsignedInteger('level')->default(1);

            // When the skill was unlocked
            $table->timestamp('unlocked_at')->nullable();

            $table->timestamps();

            // A player cannot unlock the same skill twice
            $table->unique(['user_id', 'skill_id']);

            $table->index('user_id');
            $table->index('skill_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_skills');
    }
};

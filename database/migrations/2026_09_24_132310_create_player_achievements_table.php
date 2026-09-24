<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_achievements', function (Blueprint $table) {
            $table->id();

            // Player who unlocked the achievement
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Achievement that was unlocked
            $table->foreignId('achievement_id')
                ->constrained('achievements')
                ->cascadeOnDelete();

            // When the achievement was unlocked
            $table->timestamp('unlocked_at');

            $table->timestamps();

            // A player can only unlock an achievement once
            $table->unique(['user_id', 'achievement_id']);

            $table->index('user_id');
            $table->index('achievement_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_achievements');
    }
};

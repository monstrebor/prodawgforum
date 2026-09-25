<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chess_game_players', function (Blueprint $table) {
            $table->id();

            $table->foreignId('game_id')
                ->constrained('chess_games')
                ->cascadeOnDelete();

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->enum('color', [
                'white',
                'black',
            ]);

            $table->timestamp('joined_at')->nullable();

            $table->timestamps();

            $table->unique([
                'game_id',
                'user_id',
            ]);

            $table->unique([
                'game_id',
                'color',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chess_game_players');
    }
};

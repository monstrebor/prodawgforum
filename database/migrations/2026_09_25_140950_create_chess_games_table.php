<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chess_games', function (Blueprint $table) {
            $table->id();

            $table->enum('mode', [
                'single',
                'multiplayer',
            ]);

            $table->foreignId('white_player_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->foreignId('black_player_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('ai_difficulty', [
                'easy',
                'medium',
                'hard',
                'expert',
            ])->nullable();

            $table->enum('status', [
                'waiting',
                'active',
                'completed',
                'abandoned',
            ])->default('waiting');

            $table->enum('current_turn', [
                'white',
                'black',
            ])->default('white');

            $table->longText('board_state')->nullable();

            $table->foreignId('winner_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->enum('result', [
                'white_win',
                'black_win',
                'draw',
                'resignation',
                'timeout',
                'checkmate',
                'stalemate',
            ])->nullable();

            $table->timestamp('started_at')->nullable();
            $table->timestamp('ended_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chess_games');
    }
};

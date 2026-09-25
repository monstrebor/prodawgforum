<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chess_moves', function (Blueprint $table) {
            $table->id();

            $table->foreignId('game_id')
                ->constrained('chess_games')
                ->cascadeOnDelete();

            $table->foreignId('player_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->unsignedInteger('move_number');

            $table->string('from_square', 2);
            $table->string('to_square', 2);

            $table->string('piece', 20);
            $table->string('captured_piece', 20)->nullable();

            $table->string('promotion_piece', 20)->nullable();

            $table->string('notation', 20)->nullable();

            $table->longText('board_state')->nullable();

            $table->timestamps();

            $table->index([
                'game_id',
                'move_number',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chess_moves');
    }
};

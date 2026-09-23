<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_actions', function (Blueprint $table) {
            $table->id();

            // Player performing the action
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Player being targeted
            $table->foreignId('target_user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnDelete();

            // attack, give, revive, etc.
            $table->string('action_type', 50);

            // Amount involved in the action
            // Example: -2 for attack, +1 for give/revive
            $table->integer('amount')->default(0);

            $table->timestamps();

            // Helps with cooldown/rate-limit queries
            $table->index(
                [
                    'user_id',
                    'target_user_id',
                    'action_type',
                    'created_at'
                ],
                'player_actions_lookup_idx'
            );

            // Helps with user's action history/cooldown queries
            $table->index(
                [
                    'user_id',
                    'action_type',
                    'created_at'
                ],
                'player_actions_user_action_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_actions');
    }
};

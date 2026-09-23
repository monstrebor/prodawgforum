<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_quests', function (Blueprint $table) {
            $table->id();

            // Player doing the quest
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Quest being completed
            $table->foreignId('quest_id')
                ->constrained('quests')
                ->cascadeOnDelete();

            // Current progress
            $table->unsignedInteger('progress')->default(0);

            // Required progress to complete the quest
            $table->unsignedInteger('target')->default(1);

            // in_progress, completed, abandoned
            $table->string('status', 30)->default('in_progress');

            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();

            $table->timestamps();

            // A player should not have duplicate instances
            // of the same quest unless you later intentionally
            // support repeatable quests.
            $table->unique(['user_id', 'quest_id']);

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_quests');
    }
};

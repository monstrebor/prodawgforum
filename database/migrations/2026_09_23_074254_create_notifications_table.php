<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();

            // User receiving the notification
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // User who caused/sent the notification
            // Nullable because system notifications have no sender.
            $table->foreignId('sender_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Examples:
            // life_given
            // attack
            // revive
            // life_zero
            // quest_completed
            // achievement_unlocked
            // guild_invite
            // guild_joined
            // system
            $table->string('type', 50);

            $table->text('message');

            $table->boolean('is_read')->default(false);

            $table->timestamps();

            // Quickly retrieve a user's notifications
            $table->index(['user_id', 'is_read']);

            // Useful for notification history
            $table->index(['user_id', 'created_at']);

            // Useful for filtering notification types
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};

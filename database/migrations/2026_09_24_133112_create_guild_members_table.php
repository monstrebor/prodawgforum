<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guild_members', function (Blueprint $table) {
            $table->id();

            // Guild
            $table->foreignId('guild_id')
                ->constrained('guilds')
                ->cascadeOnDelete();

            // Member
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // owner, officer, member, etc.
            $table->string('role', 30)->default('member');

            $table->timestamp('joined_at')->useCurrent();

            $table->timestamps();

            // A user can only be a member of the same guild once.
            $table->unique(['guild_id', 'user_id']);

            $table->index('guild_id');
            $table->index('user_id');
            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guild_members');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();

            // Achievement information
            $table->string('name');
            $table->text('description')->nullable();

            // Icon name/path
            $table->string('icon')->nullable();

            // Example:
            // attacks, revives, survivors, guardians, level
            $table->string('requirement_type', 50);

            // Example:
            // 1 attack
            // 10 revives
            // 50 different players
            // level 10
            $table->unsignedBigInteger('requirement_value')->default(1);

            // Rewards
            $table->unsignedBigInteger('reward_xp')->default(0);
            $table->unsignedBigInteger('reward_gold')->default(0);

            $table->timestamps();

            $table->index('requirement_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};

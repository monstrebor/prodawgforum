<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quests', function (Blueprint $table) {
            $table->id();

            // Quest information
            $table->string('name');
            $table->text('description')->nullable();

            // Example: post, social, help, daily, achievement
            $table->string('type', 50);

            // Rewards
            $table->unsignedBigInteger('xp_reward')->default(0);
            $table->unsignedBigInteger('gold_reward')->default(0);
            $table->integer('life_reward')->default(0);

            // Energy required to complete the quest
            $table->unsignedInteger('energy_cost')->default(0);

            // draft, active, inactive
            $table->string('status', 20)->default('active');

            $table->timestamps();

            // Useful for filtering active quests
            $table->index('type');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quests');
    }
};

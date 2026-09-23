<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();

            // Skill information
            $table->string('name');
            $table->text('description')->nullable();

            // Resource costs
            $table->unsignedInteger('mana_cost')->default(0);
            $table->unsignedInteger('energy_cost')->default(0);

            // Cooldown in seconds
            $table->unsignedInteger('cooldown')->default(0);

            // damage, heal, defense, buff, debuff, etc.
            $table->string('effect_type', 50);

            // Amount of the effect
            $table->integer('effect_value')->default(0);

            $table->timestamps();

            $table->index('effect_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};

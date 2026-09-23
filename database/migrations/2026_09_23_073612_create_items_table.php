<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            // Item information
            $table->string('name');
            $table->text('description')->nullable();

            // consumable, weapon, armor, accessory, etc.
            $table->string('type', 50);

            // common, uncommon, rare, epic, legendary, etc.
            $table->string('rarity', 30)->default('common');

            // Base item value / shop value
            $table->unsignedBigInteger('value')->default(0);

            // life, attack, defense, energy, xp, etc.
            $table->string('effect_type', 50)->nullable();

            // Amount of the effect
            $table->integer('effect_value')->default(0);

            $table->timestamps();

            // Useful when filtering the item catalog
            $table->index('type');
            $table->index('rarity');
            $table->index('effect_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};

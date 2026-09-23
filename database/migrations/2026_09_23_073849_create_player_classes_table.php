<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_classes', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->text('description')->nullable();

            // Base RPG stats
            $table->unsignedInteger('base_attack')->default(0);
            $table->unsignedInteger('base_defense')->default(0);
            $table->unsignedInteger('base_energy')->default(10);
            $table->unsignedInteger('base_life')->default(10);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_classes');
    }
};

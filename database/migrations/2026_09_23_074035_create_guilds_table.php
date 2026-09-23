<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guilds', function (Blueprint $table) {
            $table->id();

            // Guild information
            $table->string('name')->unique();
            $table->text('description')->nullable();

            // Player who created/owns the guild
            $table->foreignId('owner_id')
                ->constrained('users')
                ->restrictOnDelete();

            // Guild progression
            $table->unsignedInteger('level')->default(1);
            $table->unsignedBigInteger('experience')->default(0);

            $table->timestamps();

            $table->index('owner_id');
            $table->index('level');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guilds');
    }
};

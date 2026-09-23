<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('playerstats', function (Blueprint $table) {
            $table->id();

            // User who owns these RPG stats
            $table->foreignId('userid')
                ->constrained('users')
                ->cascadeOnDelete();

            // ❤️ Life
            $table->unsignedInteger('lifepoints')->default(10);
            $table->unsignedInteger('maxlifepoints')->default(10);

            // ⭐ Experience / Level
            $table->unsignedBigInteger('xp')->default(0);
            $table->unsignedInteger('level')->default(1);

            // ⚡ Energy
            $table->unsignedInteger('energy')->default(10);
            $table->unsignedInteger('maxenergy')->default(10);

            // 🪙 Currency
            $table->unsignedBigInteger('gold')->default(100);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('playerstats');
    }
};

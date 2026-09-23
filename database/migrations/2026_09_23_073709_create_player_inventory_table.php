<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('player_inventory', function (Blueprint $table) {
            $table->id();

            // Player who owns the item
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Item being owned
            $table->foreignId('item_id')
                ->constrained('items')
                ->cascadeOnDelete();

            // Number of this item owned
            $table->unsignedInteger('quantity')->default(1);

            $table->timestamps();

            // Prevent duplicate inventory rows for the same item
            // belonging to the same player.
            $table->unique(['user_id', 'item_id']);

            $table->index('user_id');
            $table->index('item_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_inventory');
    }
};

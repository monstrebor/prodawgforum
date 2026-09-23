<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('point_transactions', function (Blueprint $table) {
            $table->id();

            // Who performed the action
            $table->foreignId('from_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // Who received/lost the Life Points
            $table->foreignId('to_user_id')
                ->constrained('users')
                ->cascadeOnDelete();

            // Positive = gained
            // Negative = lost
            $table->integer('amount');

            // give, attack, revive, reward, penalty, etc.
            $table->string('type', 50);

            // Human-readable explanation
            $table->string('reason')->nullable();

            $table->timestamps();

            // Useful for Recent Activity queries
            $table->index('to_user_id');
            $table->index('from_user_id');
            $table->index('type');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('point_transactions');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('playerstats', function (Blueprint $table) {
            $table->foreignId('class_id')
                ->nullable()
                ->after('userid')
                ->constrained('player_classes')
                ->nullOnDelete();

            $table->unsignedInteger('attack')->default(0);
            $table->unsignedInteger('defense')->default(0);
        });
    }

    public function down(): void
    {
        Schema::table('playerstats', function (Blueprint $table) {
            $table->dropForeign(['class_id']);
            $table->dropColumn([
                'class_id',
                'attack',
                'defense',
            ]);
        });
    }
};

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChessGamePlayer extends Model
{
    protected $table = 'chess_game_players';

    protected $fillable = [
        'game_id',
        'user_id',
        'color',
        'joined_at',
    ];

    protected $casts = [
        'joined_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function game(): BelongsTo
    {
        return $this->belongsTo(ChessGame::class, 'game_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

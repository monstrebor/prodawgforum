<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChessMove extends Model
{
    protected $fillable = [
        'game_id',
        'player_id',
        'move_number',
        'from_square',
        'to_square',
        'piece',
        'captured_piece',
        'promotion_piece',
        'notation',
        'board_state',
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

    public function player(): BelongsTo
    {
        return $this->belongsTo(User::class, 'player_id');
    }
}

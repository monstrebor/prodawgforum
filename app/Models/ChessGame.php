<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ChessGame extends Model
{
    protected $fillable = [
        'mode',
        'white_player_id',
        'black_player_id',
        'ai_difficulty',
        'status',
        'current_turn',
        'board_state',
        'winner_id',
        'result',
        'started_at',
        'ended_at',
    ];

    protected function casts(): array
    {
        return [
            'started_at' => 'datetime',
            'ended_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function whitePlayer(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'white_player_id'
        );
    }

    public function blackPlayer(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'black_player_id'
        );
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'winner_id'
        );
    }

    public function moves(): HasMany
    {
        return $this->hasMany(
            ChessMove::class,
            'game_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Direct chess_game_players relationship
    |--------------------------------------------------------------------------
    */

    public function gamePlayers(): HasMany
    {
        return $this->hasMany(
            ChessGamePlayer::class,
            'game_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Users participating in the game
    |--------------------------------------------------------------------------
    */

    public function players(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'chess_game_players',
            'game_id',
            'user_id'
        )
        ->withPivot([
            'color',
            'joined_at',
        ])
        ->withTimestamps();
    }
}


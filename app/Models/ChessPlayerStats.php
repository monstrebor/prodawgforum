<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChessPlayerStats extends Model
{
    protected $fillable = [
        'user_id',
        'rating',
        'games_played',
        'wins',
        'losses',
        'draws',
    ];

    protected $casts = [
        'rating' => 'integer',
        'games_played' => 'integer',
        'wins' => 'integer',
        'losses' => 'integer',
        'draws' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

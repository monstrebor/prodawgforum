<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlayerQuest extends Model
{
    protected $table = 'player_quests';

    protected $fillable = [
        'user_id',
        'quest_id',
        'progress',
        'target',
        'status',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'progress' => 'integer',
        'target' => 'integer',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quest(): BelongsTo
    {
        return $this->belongsTo(Quest::class);
    }
}

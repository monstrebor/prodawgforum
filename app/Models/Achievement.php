<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Achievement extends Model
{
    protected $fillable = [
        'name',
        'description',
        'icon',
        'requirement_type',
        'requirement_value',
        'reward_xp',
        'reward_gold',
    ];

    protected $casts = [
        'requirement_value' => 'integer',
        'reward_xp' => 'integer',
        'reward_gold' => 'integer',
    ];

    public function playerAchievements(): HasMany
    {
        return $this->hasMany(PlayerAchievement::class);
    }
}

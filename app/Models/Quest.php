<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quest extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'xp_reward',
        'gold_reward',
        'life_reward',
        'energy_cost',
        'status',
    ];

    protected $casts = [
        'xp_reward' => 'integer',
        'gold_reward' => 'integer',
        'life_reward' => 'integer',
        'energy_cost' => 'integer',
    ];

    public function playerQuests()
    {
        return $this->hasMany(PlayerQuest::class);
    }
}

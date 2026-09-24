<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Skill extends Model
{
    protected $fillable = [
        'name',
        'description',
        'mana_cost',
        'energy_cost',
        'cooldown',
        'effect_type',
        'effect_value',
    ];

    protected $casts = [
        'mana_cost' => 'integer',
        'energy_cost' => 'integer',
        'cooldown' => 'integer',
        'effect_value' => 'integer',
    ];

    public function playerSkills(): HasMany
    {
        return $this->hasMany(PlayerSkill::class);
    }
}

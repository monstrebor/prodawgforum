<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PlayerClass extends Model
{
    protected $table = 'player_classes';

    protected $fillable = [
        'name',
        'description',
        'base_attack',
        'base_defense',
        'base_energy',
        'base_life',
    ];

    protected $casts = [
        'base_attack' => 'integer',
        'base_defense' => 'integer',
        'base_energy' => 'integer',
        'base_life' => 'integer',
    ];

    public function playerStats(): HasMany
    {
        return $this->hasMany(PlayerStats::class, 'class_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerStats extends Model
{
    use HasFactory;
    protected $fillable = [
        'userid',
        'class_id',
        'lifepoints',
        'maxlifepoints',
        'xp',
        'level',
        'energy',
        'maxenergy',
        'gold',
        'attack',
        'defense',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function playerClass()
    {
        return $this->belongsTo(
            PlayerClass::class,
            'class_id'
        );
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'name',
        'description',
        'type',
        'rarity',
        'value',
        'effect_type',
        'effect_value',
    ];

    protected $casts = [
        'value' => 'integer',
        'effect_value' => 'integer',
    ];
}

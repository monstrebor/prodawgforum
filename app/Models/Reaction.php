<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'type',
    ];

    public function image()
    {
        return $this->belongsTo(PostImage::class, 'post_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


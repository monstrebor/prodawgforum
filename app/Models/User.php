<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['name', 'email', 'role', 'status', 'is_new', 'password', 'email_verified_at', 'remember_token'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'posted_by', 'id');
    }

    public function sentFriendships()
    {
        return $this->hasMany(Friendship::class, 'sender_id');
    }

    public function receivedFriendships()
    {
        return $this->hasMany(Friendship::class, 'receiver_id');

    }
    public function friends()
    {
        return $this->belongsToMany(User::class, 'friendships', 'sender_id', 'receiver_id')
            ->wherePivot('status', 'accepted')
            ->withTimestamps();
    }

    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    // RPG PART
    public function playerStats()
    {
        return $this->hasOne(PlayerStats::class, 'userid');
    }

    public function receivedPointTransactions()
    {
        return $this->hasMany(
            PointTransaction::class,
            'to_user_id'
        );
    }
    public function sentPointTransactions()
    {
        return $this->hasMany(
            PointTransaction::class,
            'from_user_id'
        );
    }

    public function playerQuests()
    {
        return $this->hasMany(PlayerQuest::class);
    }

    public function inventory()
    {
        return $this->hasMany(PlayerInventory::class);
    }

    public function achievements()
    {
        return $this->hasMany(PlayerAchievement::class);
    }

    public function playerSkills()
    {
        return $this->hasMany(PlayerSkill::class);
    }

    public function guildMemberships()
    {
        return $this->hasMany(GuildMember::class);
    }

    public function ownedGuilds()
    {
        return $this->hasMany(Guild::class, 'owner_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function sentNotifications()
    {
        return $this->hasMany(Notification::class, 'sender_id');
    }
}


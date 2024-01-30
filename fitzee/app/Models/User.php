<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Profile;
use App\Models\Exercise;
use DevKylian\Uuid\HasUuid;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasUuid;

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    const STATUS_NOT_VERIFIED = 0;
    const STATUS_VERIFIED = 1;
    const STATUS_BANNED = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isUser()
    {
        return $this->role === self::ROLE_USER;
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function series()
    {
        return $this->hasMany(Serie::class)->latest();
    }

    public function program()
    {
        return $this->hasOneThrough(Program::class, Profile::class);
    }

    public function exercises()
    {
        return $this->belongsToMany(Exercise::class, 'user_exercises');
    }
}

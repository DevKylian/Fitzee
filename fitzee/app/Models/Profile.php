<?php

namespace App\Models;

use App\Models\User;
use DevKylian\Uuid\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Profile extends Model
{
    use HasFactory, HasUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }
}

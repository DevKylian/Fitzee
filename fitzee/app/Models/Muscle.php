<?php

namespace App\Models;

use App\Models\Exercise;
use DevKylian\Uuid\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Muscle extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'muscles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }
}

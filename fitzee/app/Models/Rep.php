<?php

namespace App\Models;

use DevKylian\Uuid\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rep extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'reps';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

}

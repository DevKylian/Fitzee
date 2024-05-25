<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Exercise;
use DevKylian\Uuid\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Serie extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'series';
    protected $appends = ['formatted_created_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function exercise()
    {
        return $this->belongsTo(Exercise::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function reps() {
        return $this->hasMany(Rep::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d M Y');
    }
}

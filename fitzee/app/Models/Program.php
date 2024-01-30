<?php

namespace App\Models;

use Carbon\Carbon;
use DevKylian\Uuid\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'programs';

    const STATUS_NEXT = 0;
    const STATUS_DONE = 1;

    protected $guarded = [];


    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function series()
    {
        return $this->hasMany(Serie::class);
    }

    public function toggleStatus()
    {
        $this->status = $this->status == 1 ? 0 : 1;
        $this->save();
    }
}

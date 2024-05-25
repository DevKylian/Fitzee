<?php

namespace App\Models;

use App\Models\User;
use App\Models\Serie;
use App\Models\Muscle;
use DevKylian\Uuid\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Exercise extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'exercises';

    const PEC_GRAND_PECTORAL = 100;
    const PEC_SUPERIOR = 101;
    const PEC_MEDIAN = 102;
    const PEC_INFERIOR = 103;

    const SHOULDER_ANTERIOR = 200;
    const SHOULDER_MEDIAN = 201;
    const SHOULDER_POSTERIOR = 202;

    const TRICEPS_GLOBAL = 300;
    const TRICEPS_LATERAL = 301;
    const TRICEPS_LONG = 302;

    const BRAS_BICEPS = 400;
    const BRAS_AVANT_BRAS = 401;

    const DOS_GRAND_DORSAL = 500;
    const DOS_TRAPEZES = 501;
    const DOS_RHOMBOIDES = 502;
    const DOS_GRAND_ROND = 503;
    const DOS_LOMBAIRES = 504;

    const LEGS_QUADRICEPS = 600;
    const LEGS_HAMSTRINGS = 601;
    const LEGS_CALVES = 602;
    const LEGS_ADDUCTORS = 603;
    const LEGS_GLUTES = 604;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function muscle()
    {
        return $this->belongsTo(Muscle::class);
    }

    public function series()
    {
        return $this->hasMany(Serie::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_exercises');
    }

    public function userExercises()
    {
        return $this->hasMany(UserExercise::class);
    }

    public function programs()
    {
        return $this->belongsToMany(Program::class);
    }

    public static function getMuscleGroups() {
        return [
            'pectoral' => [
                self::PEC_GRAND_PECTORAL,
                self::PEC_SUPERIOR,
                self::PEC_MEDIAN,
                self::PEC_INFERIOR,
            ],
            'shoulder' => [
                self::SHOULDER_ANTERIOR,
                self::SHOULDER_MEDIAN,
                self::SHOULDER_POSTERIOR,
            ],
            'triceps' => [
                self::TRICEPS_GLOBAL,
                self::TRICEPS_LATERAL,
                self::TRICEPS_LONG,
            ],
            'bras' => [
                self::BRAS_BICEPS,
                self::BRAS_AVANT_BRAS,
            ],
            'dos' => [
                self::DOS_GRAND_DORSAL,
                self::DOS_TRAPEZES,
                self::DOS_RHOMBOIDES,
                self::DOS_GRAND_ROND,
                self::DOS_LOMBAIRES,
            ],
            'legs' => [
                self::LEGS_QUADRICEPS,
                self::LEGS_HAMSTRINGS,
                self::LEGS_CALVES,
                self::LEGS_ADDUCTORS,
                self::LEGS_GLUTES,
            ],
        ];
    }
}

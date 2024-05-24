<?php

namespace App\Models;

use App\Models\User;
use Carbon\Carbon;
use DevKylian\Uuid\HasUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Session;

class Profile extends Model
{
    use HasFactory, HasUuid;

    protected $table = 'profile';

    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    const PROGRAM_TYPE_FULLBODY = 1;
    const PROGRAM_TYPE_PPL = 2;
    const PROGRAM_TYPE_SPLIT = 3;
    const PROGRAM_TYPE_UPPERLOWER = 4;

    const GOAL_BUILDMUSCLE = 1;
    const GOAL_FATLOSS = 2;
    const GOAL_STRENGTHMUSCLE = 3;

    const GYM_FREQUENTATION_1 = 1;
    const GYM_FREQUENTATION_2 = 2;
    const GYM_FREQUENTATION_3 = 3;
    const GYM_FREQUENTATION_4 = 4;
    const GYM_FREQUENTATION_5 = 5;
    const GYM_FREQUENTATION_6 = 6;
    const GYM_FREQUENTATION_7 = 7;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function programs()
    {
        return $this->hasMany(Program::class);
    }

    public static function getProgramOptions()
    {
        return [
            ['text' => 'Full body', 'value' => self::PROGRAM_TYPE_FULLBODY],
            ['text' => 'PPL', 'value' => self::PROGRAM_TYPE_PPL],
            ['text' => 'Split', 'value' => self::PROGRAM_TYPE_SPLIT],
            ['text' => 'Upper/Lower', 'value' => self::PROGRAM_TYPE_UPPERLOWER],
        ];
    }

    public static function getProgramSpecifics()
    {
        return [
            self::PROGRAM_TYPE_FULLBODY => ['min' => 1, 'max' => 3],
            self::PROGRAM_TYPE_PPL => ['values' => [3, 6]],
            self::PROGRAM_TYPE_SPLIT => ['min' => 4, 'max' => 7],
            self::PROGRAM_TYPE_UPPERLOWER => ['min' => 3, 'max' => 6],
        ];
    }

    public static function getGenderOptions()
    {
        return [
            ['text' => 'Man', 'value' => self::GENDER_MALE],
            ['text' => 'Female', 'value' => self::GENDER_FEMALE],
        ];
    }

    public static function getGoalOptions()
    {
        return [
            ['text' => 'Build muscle', 'value' => self::GOAL_BUILDMUSCLE],
            ['text' => 'Loose fat', 'value' => self::GOAL_FATLOSS],
            ['text' => 'Muscle strengthening', 'value' => self::GOAL_STRENGTHMUSCLE],
        ];
    }

    public static function getGymFrequentationOptions()
    {
        return [
            ['text' => '1', 'value' => self::GYM_FREQUENTATION_1],
            ['text' => '2', 'value' => self::GYM_FREQUENTATION_2],
            ['text' => '3', 'value' => self::GYM_FREQUENTATION_3],
            ['text' => '4', 'value' => self::GYM_FREQUENTATION_4],
            ['text' => '5', 'value' => self::GYM_FREQUENTATION_5],
            ['text' => '6', 'value' => self::GYM_FREQUENTATION_6],
            ['text' => '7', 'value' => self::GYM_FREQUENTATION_7],
        ];
    }

    public static function getGenderValues()
    {
        return [
            self::GENDER_MALE,
            self::GENDER_FEMALE,
        ];
    }

    public static function getProgramTypeValues()
    {
        return [
            self::PROGRAM_TYPE_FULLBODY,
            self::PROGRAM_TYPE_PPL,
            self::PROGRAM_TYPE_SPLIT,
            self::PROGRAM_TYPE_UPPERLOWER,
        ];
    }

    public static function getGymFrequentationValues()
    {
        return [
            self::GYM_FREQUENTATION_1,
            self::GYM_FREQUENTATION_2,
            self::GYM_FREQUENTATION_3,
            self::GYM_FREQUENTATION_4,
            self::GYM_FREQUENTATION_5,
            self::GYM_FREQUENTATION_6,
            self::GYM_FREQUENTATION_7,
        ];
    }

    public static function getDaysRemainingText($goalDate)
    {
        $currentDate = Carbon::now();
        $goalDate = Carbon::parse($goalDate);

        if ($goalDate->isToday()) {
            return 'Today';
        } elseif ($goalDate->isTomorrow()) {
            return 'Tomorrow';
        } elseif ($goalDate->lt($currentDate)) {
            return 'Already reached';
        } else {
            $daysRemaining = $currentDate->diffInDays($goalDate);
            return $daysRemaining . ' days';
        }
    }

    public static function getProgramTypeText($programTypeId)
    {
        $programOptions = Profile::getProgramOptions();

        foreach ($programOptions as $programOption) {
            if ($programOption['value'] === $programTypeId) {
                return $programOption['text'];
            }
        }

        return '0';
    }

    public function isComplete() {
        return $this->gender
            && $this->goal
            && $this->goal_date
            && $this->age
            && $this->weight
            && $this->weight_goal
            && $this->size
            && $this->program_type
            && $this->gym_frequentation
            && $this->gym_experience;
    }
}

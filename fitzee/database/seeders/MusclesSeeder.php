<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Muscle;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class MusclesSeeder extends Seeder
{
    public function run()
    {
        $muscles = [
            [
                'name' => 'Pectorals',
                'color' => 'yellow',
                'icon' => 'pectorals',
            ],
            [
                'name' => 'Legs',
                'color' => 'orange',
                'icon' => 'legs',
            ],
            [
                'name' => 'Shoulders',
                'color' => 'brown',
                'icon' => 'shoulders',
            ],
            [
                'name' => 'Arms',
                'color' => 'red',
                'icon' => 'arms',
            ],
            [
                'name' => 'Triceps',
                'color' => 'red',
                'icon' => 'triceps',
            ],
            [
                'name' => 'Back',
                'color' => 'black',
                'icon' => 'back',
            ],
        ];

        foreach ($muscles as $muscle) Muscle::create($muscle);
    }
}

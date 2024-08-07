<?php

namespace Database\Seeders;

use App\Models\Muscle;
use App\Models\Exercise;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ExercisesSeeder extends Seeder
{
    public function run()
    {
        $exercises = [
            // Triceps
            [
                'name' => 'Triceps Pushdown',
                'muscle_id' => Muscle::where('name', 'triceps')->first()->id,
                'slug' => 'triceps-pushdown',
                'img' => 'triceps-pushdown',
                'tutorial' => 'triceps-pushdown-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::TRICEPS_GLOBAL,
            ],
            [
                'name' => 'Skull Crushers',
                'muscle_id' => Muscle::where('name', 'triceps')->first()->id,
                'slug' => 'skull-crushers',
                'img' => 'skull-crushers',
                'tutorial' => 'skull-crushers-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::TRICEPS_LONG,
            ],
            [
                'name' => 'Triceps Dips',
                'muscle_id' => Muscle::where('name', 'triceps')->first()->id,
                'slug' => 'triceps-dips',
                'img' => 'triceps-dips',
                'tutorial' => 'triceps-dips-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::TRICEPS_LATERAL,
            ],
            [
                'name' => 'Triceps Kickbacks',
                'muscle_id' => Muscle::where('name', 'triceps')->first()->id,
                'slug' => 'triceps-kickbacks',
                'img' => 'triceps-kickbacks',
                'tutorial' => 'triceps-kickbacks-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::TRICEPS_LATERAL,
            ],
            // Shoulders
            [
                'name' => 'Military Press',
                'muscle_id' => Muscle::where('name', 'shoulders')->first()->id,
                'slug' => 'military-press',
                'img' => 'military-press',
                'tutorial' => 'military-press-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::SHOULDER_ANTERIOR,
            ],
            [
                'name' => 'Lateral Raises',
                'muscle_id' => Muscle::where('name', 'shoulders')->first()->id,
                'slug' => 'lateral-raises',
                'img' => 'lateral-raises',
                'tutorial' => 'lateral-raises-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::SHOULDER_MEDIAN,
            ],
            [
                'name' => 'Front Raises',
                'muscle_id' => Muscle::where('name', 'shoulders')->first()->id,
                'slug' => 'front-raises',
                'img' => 'front-raises',
                'tutorial' => 'front-raises-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::SHOULDER_ANTERIOR,
            ],
            [
                'name' => 'Seated Dumbbell Press',
                'muscle_id' => Muscle::where('name', 'shoulders')->first()->id,
                'slug' => 'seated-dumbbell-press',
                'img' => 'seated-dumbbell-press',
                'tutorial' => 'seated-dumbbell-press-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::SHOULDER_MEDIAN,
            ],
            [
                'name' => 'Face Pulls',
                'muscle_id' => Muscle::where('name', 'shoulders')->first()->id,
                'slug' => 'face-pulls',
                'img' => 'face-pulls',
                'tutorial' => 'face-pulls-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::SHOULDER_POSTERIOR,
            ],
            // Pectorals
            [
                'name' => 'Bench Press',
                'muscle_id' => Muscle::where('name', 'pectorals')->first()->id,
                'slug' => 'bench-press',
                'img' => 'bench-press',
                'tutorial' => 'bench-press-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::PEC_GRAND_PECTORAL,
            ],
            [
                'name' => 'Incline Dumbbell Press',
                'muscle_id' => Muscle::where('name', 'pectorals')->first()->id,
                'slug' => 'incline-dumbbell-press',
                'img' => 'incline-dumbbell-press',
                'tutorial' => 'incline-dumbbell-press-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::PEC_SUPERIOR,
            ],
            [
                'name' => 'Chest Flyes',
                'muscle_id' => Muscle::where('name', 'pectorals')->first()->id,
                'slug' => 'chest-flyes',
                'img' => 'chest-flyes',
                'tutorial' => 'chest-flyes-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::PEC_MEDIAN,
            ],
            [
                'name' => 'Push-Ups',
                'muscle_id' => Muscle::where('name', 'pectorals')->first()->id,
                'slug' => 'push-ups',
                'img' => 'push-ups',
                'tutorial' => 'push-ups-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::PEC_GRAND_PECTORAL,
            ],
            [
                'name' => 'Incline Bench Press',
                'muscle_id' => Muscle::where('name', 'pectorals')->first()->id,
                'slug' => 'incline-bench-press',
                'img' => 'incline-bench-press',
                'tutorial' => 'incline-bench-press-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::PEC_SUPERIOR,
            ],
            [
                'name' => 'Decline Bench Press',
                'muscle_id' => Muscle::where('name', 'pectorals')->first()->id,
                'slug' => 'decline-bench-press',
                'img' => 'decline-bench-press',
                'tutorial' => 'decline-bench-press-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::PEC_INFERIOR,
            ],
            // Bras
            [
                'name' => 'Biceps Curls',
                'muscle_id' => Muscle::where('name', 'arms')->first()->id,
                'slug' => 'biceps-curls',
                'img' => 'biceps-curls',
                'tutorial' => 'biceps-curls-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => true,
                'muscle_part' => Exercise::BRAS_BICEPS,
            ],
            [
                'name' => 'Hammer Curls',
                'muscle_id' => Muscle::where('name', 'arms')->first()->id,
                'slug' => 'hammer-curls',
                'img' => 'hammer-curls',
                'tutorial' => 'hammer-curls-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => true,
                'muscle_part' => Exercise::BRAS_BICEPS,
            ],
            [
                'name' => 'Concentration Curls',
                'muscle_id' => Muscle::where('name', 'arms')->first()->id,
                'slug' => 'concentration-curls',
                'img' => 'concentration-curls',
                'tutorial' => 'concentration-curls-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'isolation',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::BRAS_BICEPS,
            ],
            [
                'name' => 'Reverse Curls',
                'muscle_id' => Muscle::where('name', 'arms')->first()->id,
                'slug' => 'reverse-curls',
                'img' => 'reverse-curls',
                'tutorial' => 'reverse-curls-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'isolation',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::BRAS_BICEPS,
            ],
            [
                'name' => 'Waiter Curls',
                'muscle_id' => Muscle::where('name', 'arms')->first()->id,
                'slug' => 'waiter-curls',
                'img' => 'waiter-curls',
                'tutorial' => 'waiter-curls-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'isolation',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::BRAS_AVANT_BRAS,
            ],
            // Dos
            [
                'name' => 'Horizontal pull',
                'muscle_id' => Muscle::where('name', 'back')->first()->id,
                'slug' => 'horizontal-pull',
                'img' => 'horizontal-pull',
                'tutorial' => 'horizontal-pull-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => true,
                'muscle_part' => Exercise::DOS_GRAND_DORSAL,
            ],
            [
                'name' => 'Shrugs',
                'muscle_id' => Muscle::where('name', 'back')->first()->id,
                'slug' => 'shrugs',
                'img' => 'shrugs',
                'tutorial' => 'shrugs-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'isolation',
                'difficulty' => 'medium',
                'polyarticular' => false,
                'muscle_part' => Exercise::DOS_TRAPEZES,
            ],
            [
                'name' => 'Rowing T',
                'muscle_id' => Muscle::where('name', 'back')->first()->id,
                'slug' => 'rowing-t',
                'img' => 'rowing-t',
                'tutorial' => 'rowing-t-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'medium',
                'polyarticular' => true,
                'muscle_part' => Exercise::DOS_RHOMBOIDES,
            ],
            [
                'name' => 'Pull-ups',
                'muscle_id' => Muscle::where('name', 'back')->first()->id,
                'slug' => 'pull-ups',
                'img' => 'pull-ups',
                'tutorial' => 'pull-ups-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'hard',
                'polyarticular' => true,
                'muscle_part' => Exercise::DOS_GRAND_ROND,
            ],
            // Quadriceps
            [
                'name' => 'Squats',
                'muscle_id' => Muscle::where('name', 'legs')->first()->id,
                'slug' => 'squats',
                'img' => 'squats',
                'tutorial' => 'squats-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'intermediate',
                'polyarticular' => true,
                'muscle_part' => Exercise::LEGS_QUADRICEPS,
            ],
            [
                'name' => 'Leg Press',
                'muscle_id' => Muscle::where('name', 'legs')->first()->id,
                'slug' => 'leg-press',
                'img' => 'leg-press',
                'tutorial' => 'leg-press-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'intermediate',
                'polyarticular' => true,
                'muscle_part' => Exercise::LEGS_QUADRICEPS,
            ],
            [
                'name' => 'Leg curl',
                'muscle_id' => Muscle::where('name', 'back')->first()->id,
                'slug' => 'leg-curl',
                'img' => 'leg-curl',
                'tutorial' => 'leg-curl-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'isolation',
                'difficulty' => 'easy',
                'polyarticular' => false,
                'muscle_part' => Exercise::DOS_LOMBAIRES,
            ],
            // Ischio-jambiers
            [
                'name' => 'Deadlift',
                'muscle_id' => Muscle::where('name', 'legs')->first()->id,
                'slug' => 'deadlift',
                'img' => 'deadlift',
                'tutorial' => 'deadlift-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'advanced',
                'polyarticular' => true,
                'muscle_part' => Exercise::LEGS_HAMSTRINGS,
            ],
            [
                'name' => 'Leg curls',
                'muscle_id' => Muscle::where('name', 'legs')->first()->id,
                'slug' => 'leg-curls',
                'img' => 'leg-curls',
                'tutorial' => 'leg-curls-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'isolated',
                'difficulty' => 'intermediate',
                'polyarticular' => false,
                'muscle_part' => Exercise::LEGS_HAMSTRINGS,
            ],
            // Mollets
            [
                'name' => 'Calf raises',
                'muscle_id' => Muscle::where('name', 'legs')->first()->id,
                'slug' => 'calf-raises',
                'img' => 'calf-raises',
                'tutorial' => 'calf-raises-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'isolated',
                'difficulty' => 'beginner',
                'polyarticular' => false,
                'muscle_part' => Exercise::LEGS_CALVES,
            ],
            [
                'name' => 'Calf seated',
                'muscle_id' => Muscle::where('name', 'legs')->first()->id,
                'slug' => 'calf-seated',
                'img' => 'calf-seated',
                'tutorial' => 'calf-seated-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'isolated',
                'difficulty' => 'beginner',
                'polyarticular' => false,
                'muscle_part' => Exercise::LEGS_CALVES,
            ],
            // Fesses
            [
                'name' => 'Straight leg deadlift',
                'muscle_id' => Muscle::where('name', 'legs')->first()->id,
                'slug' => 'straight-leg-deadlift',
                'img' => 'straight-leg-deadlift',
                'tutorial' => 'straight-leg-deadlift-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'advanced',
                'polyarticular' => true,
                'muscle_part' => Exercise::LEGS_GLUTES,
            ],
            [
                'name' => 'Bulgarian slits',
                'muscle_id' => Muscle::where('name', 'legs')->first()->id,
                'slug' => 'bulgarian-slits',
                'img' => 'bulgarian-slits',
                'tutorial' => 'bulgarian-slits-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'polyarticular',
                'difficulty' => 'intermediate',
                'polyarticular' => true,
                'muscle_part' => Exercise::LEGS_GLUTES,
            ],
            // Adductors
            [
                'name' => 'Squat cosaque',
                'muscle_id' => Muscle::where('name', 'legs')->first()->id,
                'slug' => 'squat-cosaque',
                'img' => 'squat-cosaque',
                'tutorial' => 'squat-cosaque-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'isolated',
                'difficulty' => 'intermediate',
                'polyarticular' => false,
                'muscle_part' => Exercise::LEGS_ADDUCTORS,
            ],
            [
                'name' => 'Squat pistol',
                'muscle_id' => Muscle::where('name', 'legs')->first()->id,
                'slug' => 'squat-pistol',
                'img' => 'squat-pistol',
                'tutorial' => 'squat-pistol-tutorial',
                'priority' => 90,
                'machine' => true,
                'type' => 'isolated',
                'difficulty' => 'intermediate',
                'polyarticular' => false,
                'muscle_part' => Exercise::LEGS_ADDUCTORS,
            ],
        ];

        foreach ($exercises as $exercise) Exercise::create($exercise);
    }
}

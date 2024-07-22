<?php

namespace App\Services;

use App\Models\Exercise;
use App\Models\Muscle;
use App\Models\Rep;
use App\Models\Serie;
use App\Models\UserExercise;

class ExerciseService {

    public function hasUserToggledExercisesForAllMuscles($userId)
    {
        $muscles = Muscle::all();

        foreach($muscles as $muscle) {
            $exerciseIds = Exercise::where('muscle_id', $muscle->id)->pluck('id');

            if (!UserExercise::where('user_id', $userId)->whereIn('exercise_id', $exerciseIds)->exists()) {
                return false;
            }
        }

        return true;
    }

    public function selectExercises(array $muscleGroups)
    {
        $selectedExercises = [];
        foreach ($muscleGroups as $muscleGroup) {
            $muscleParts = Exercise::getMuscleGroups()[$muscleGroup];
            foreach ($muscleParts as $muscle_part) {
                $exercise = Exercise::where('muscle_part', 'like', '%' . $muscle_part . '%')
                    ->whereNotIn('id', $selectedExercises)
                    ->inRandomOrder()
                    ->first();

                if($exercise){
                    $selectedExercises[] = $exercise->id;
                } else {
                    return response()->json(['error' => 'Aucun exercice trouvé pour le groupe musculaire : ' . $muscle_part ], 422);
                }
            }
        }

        return $selectedExercises;
    }
}

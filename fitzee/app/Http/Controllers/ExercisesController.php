<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Muscle;

class ExercisesController extends Controller
{
    public function show()
    {
        $muscles = Muscle::with('exercises.userExercises')->get();

        return Inertia::render('Exercises', [
            'muscles' => $muscles
        ]);
    }
}

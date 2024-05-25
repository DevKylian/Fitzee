<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Exercise;

class ExerciseController extends Controller
{

    public function show($slug)
    {
        $exercise = Exercise::where('slug', $slug)
            ->with([
                'muscle',
                'series' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                },
                'series.reps', // Ajouter cette ligne
            ])
            ->first();

        if (!$exercise) {
            abort(404);
        }

        return Inertia::render('Exercise', [
            'exercise' => $exercise
        ]);
    }

    public function toggleExercise($slug)
    {
        $exercise = Exercise::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        if ($user->exercises->contains($exercise->id)) {
            $user->exercises()->detach($exercise);
        } else {
            $user->exercises()->attach($exercise);
        }

        return redirect()->back();
    }
}

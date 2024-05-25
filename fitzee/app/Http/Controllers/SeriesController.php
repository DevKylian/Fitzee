<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Serie;
use App\Models\Exercise;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required|date',
            'exercise_id' => 'required',
        ]);

        $data['user_id'] = Auth::id();

        $serie = Serie::create($data);

        $exercise = Exercise::find($serie->exercise_id);

        if (!$exercise) {
            return redirect()->back()->withErrors(['weight' => 'Exercise not found.']);
        }

        $exerciseSlug = $exercise->slug;

        return Inertia::render('Exercise', [
            'slug' => $exerciseSlug,
            'success' => 'Serie successfully added !',
            'exercise' => $exercise,
        ]);
    }


}

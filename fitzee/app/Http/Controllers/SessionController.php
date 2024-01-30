<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SessionController extends Controller
{
    public function show($id)
    {
        $program = Program::findOrFail($id);
        $sessions = $program->series()->with('exercise.series.reps')->get();

        return Inertia::render('Session', [
            'sessions' => $sessions
        ]);
    }
}

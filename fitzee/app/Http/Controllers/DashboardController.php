<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $series = Serie::with(['exercise.muscle', 'reps'])->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        $profile = $user->profile;
        $profile->program_type_text = Profile::getProgramTypeText($profile->program_type);
        $daysRemainingText = Profile::getDaysRemainingText($profile->goal_date);

        return Inertia::render('Dashboard', [
            'profile' => $profile,
            'series' => $series,
            'daysRemainingText' => $daysRemainingText,
        ]);
    }
}

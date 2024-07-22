<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Inertia\Inertia;
use App\Models\Serie;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Services\ProgramService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    protected ProgramService $programService;

    public function __construct(ProgramService $programService)
    {
        $this->programService = $programService;
    }

    public function show()
    {
        $user = Auth::user();
        $series = Serie::with(['exercise.muscle', 'reps'])->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        $program = $this->programService->getUserProgramsWithStatusUpdates(Auth::user()->profile);
        $profile = $user->profile;
        $profile->program_type_text = Profile::getProgramTypeText($profile->program_type);
        $daysRemainingText = Profile::getDaysRemainingText($profile->goal_date);

        return Inertia::render('Dashboard', [
            'profile' => $profile,
            'series' => $series,
            'programs' => $program,
            'daysRemainingText' => $daysRemainingText,
        ]);
    }
}

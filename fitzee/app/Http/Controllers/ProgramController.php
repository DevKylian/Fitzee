<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Services\ProgramService;
use App\Services\ExerciseService;

class ProgramController extends Controller
{
    protected ProgramService $programService;
    protected ExerciseService $exerciseService;

    public function __construct(ProgramService $programService, ExerciseService $exerciseService)
    {
        $this->programService = $programService;
        $this->exerciseService = $exerciseService;
    }

    public function show()
    {
        $program = $this->programService->getUserProgramsWithStatusUpdates(Auth::user()->profile);

        return Inertia::render('Program', [
            'programs' => $program
        ]);
    }

    public function delete()
    {
        $this->programService->deleteUserProgram();
        return redirect()->back();
    }

    public function toggleProgram($id) {
        $this->programService->toggleUserProgramStatus($id);
        return redirect()->back();
    }

    public function generate()
    {
        return $this->programService->generateUserProgram(Auth::user());
    }
}

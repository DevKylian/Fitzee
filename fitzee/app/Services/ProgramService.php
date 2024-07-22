<?php

namespace App\Services;

use App\Models\Exercise;
use App\Models\Program;
use App\Models\Rep;
use App\Models\Serie;
use App\Models\UserExercise;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ProgramService
{
    protected ExerciseService $exerciseService;

    public function __construct(ExerciseService $exerciseService)
    {
        $this->exerciseService = $exerciseService;
    }
    public function getUserProgramsWithStatusUpdates($profile) {
        $programs = $profile->programs()->orderBy('scheduled_at')->get();

        $programs = $programs->map(function ($program) {
            $scheduledAt = Carbon::parse($program->scheduled_at);

            if (!$scheduledAt->isToday() && $scheduledAt->isPast()) {
                $program->status = 1;
                $program->save();
            }

            $program->scheduled_at_formated = $scheduledAt->diffForHumans();

            return $program;
        });

        return $programs;
    }

    public function deleteUserProgram()
    {
        $user = Auth::user();
        $profile = $user->profile;
        $program = $profile->programs;

        foreach ($program as $p) {
            $p->delete();
        }
    }

    public function toggleUserProgramStatus($id) {
        $program = Program::findOrfail($id);

        if (!$program || $program->profile->user->id != Auth::user()->id) {
            return redirect()->back()->with('info', 'Program not found or you do not have permission to modify this program');
        }

        $program->toggleStatus();

        return $program;
    }

    public function generateUserProgram($user)
    {
        if (!$this->exerciseService->hasUserToggledExercisesForAllMuscles($user->id)) {
            return response()->json(['info' => 'Vous n\'avez pas encore sélectionné vos exercices pour tous les muscles'], 422);
        }

        $profile = $user->profile;
        $gymFrequentation = $profile->gym_frequentation;
        $lastProgram = $profile->programs()->latest('scheduled_at')->first();

        if($lastProgram && Carbon::parse($lastProgram->scheduled_at)->isFuture()) {
            return response()->json(['info' => "La génération du programme n'est possible que lorsque votre programme est terminé"], 422);
        }

        $date = Carbon::now();
        $programTypes = [
            "Pectoraux / Epaules / Triceps" => ["muscles" => ["pectoral", "shoulder", "triceps"], "image" => "developpe-couche-barre"],
            "Dos / Bras" => ["muscles" => ["dos", "bras"], "image" => "rowing-barre"],
            "Jambes / Fesses" => ["muscles" => ["legs", "legs"], "image" => "squats"],
        ];
        $programNames = array_keys($programTypes);

        for ($i=0; $i < $gymFrequentation; $i++) {
            $progName = $programNames[$i % count($programNames)];
            $progType = $programTypes[$progName];
            $muscles = $progType["muscles"];
            $image = $progType["image"];

            $selectedExercises = $this->exerciseService->selectExercises($muscles);

            $program = $this->createProgram($profile, $progName, $image, $date);

            $date->addDay();

            if ($i % 3 == 2 && $i != $gymFrequentation - 1) {
                $date->addDay();
            }

            $oneRepMax = 40;

            $repData = [
                ['reps' => 10, 'weight' => 0.7 * $oneRepMax],
                ['reps' => 10, 'weight' => 0.7 * $oneRepMax],
                ['reps' => 10, 'weight' => 0.7 * $oneRepMax],
            ];

            foreach ($selectedExercises as $exerciseId) {

                // Trouver la dernière Série de cet exercice pour cet utilisateur
                $lastSerie = Serie::where('user_id', auth()->user()->id)
                    ->where('exercise_id', $exerciseId)
                    ->latest('created_at')
                    ->first();

                $lastRep = null;

                // Si la Série existe, alors trouver la dernière Reps de cette Série
                if($lastSerie) {
                    $lastRep = Rep::where('serie_id', $lastSerie->id)
                        ->latest('created_at')
                        ->first();
                }

                // Si la Reps existe, utiliser le poids précédent * 1.1, sinon utiliser une valeur par défaut
                $weight = $lastRep ? $lastRep->weight * 1.1 : 0.7 * $oneRepMax;

                $series = new Serie();
                $series->user_id = auth()->user()->id;
                $series->program_id = $program->id;
                $series->exercise_id = $exerciseId;
                $series->save();

                // Utiliser le poids calculé pour les reps
                foreach ($repData as $data) {
                    $rep = new Rep();
                    $rep->serie_id = $series->id;
                    $rep->weight = $weight; // Remplacer data['weight'] par weight
                    $rep->reps = $data['reps'];
                    $rep->save();
                }
            }
//...
        }

        return response()->json(['success' => 'Félicitations ! Votre nouveau programme a été généré avec succès.']);
    }

    private function createProgram($profile, $name, $image, $scheduled_at) {
        return Program::create([
            'name' => $name,
            'img' => $image,
            'profile_id' => $profile->id,
            'status' => Program::STATUS_NEXT,
            'scheduled_at' => $scheduled_at,
        ]);
    }
}

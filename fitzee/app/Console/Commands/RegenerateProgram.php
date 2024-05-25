<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class RegenerateProgram extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'program:regenerate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all(); // Récupération de tous les utilisateurs

        foreach ($users as $user){
            $lastSessions = $user->sessions()->where('created_at', '>=', now()->subWeek(1))->get(); // Récupère les sessions de la semaine dernière de l'utilisateur

            foreach ($lastSessions as $session) {
                $exercises = $session->exercises; // Récupère les exercices pour cette session

                foreach ($exercises as $exercise) {
                    $sets = $exercise->sets; // Récupère les séries pour cet exercice

                    // Fais quelque chose avec ces séries (par exemple, augmenter la charge)
                    foreach ($sets as $set) {
                        $newLoad = $set->load + ($set->load * 0.10); // Augmente la charge de 10%
                        // Créer une nouvelle série avec la nouvelle charge pour la semaine prochaine
                        $newSet = new ExerciseSet;
                        $newSet->load = $newLoad;
                        // Assurez-vous de lier ce nouvel ensemble à l'exercice correct pour le nouveau programme de la semaine prochaine
                    }
                }
            }
            // Une fois que toutes les charges sont augmentées, générez le nouveau programme pour l'utilisateur pour la semaine prochaine
            $user->generateNewProgram();
        }

        return 0;
    }
}

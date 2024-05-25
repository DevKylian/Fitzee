<?php

namespace App\Http\Controllers;

use App\Models\Rep;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RepController extends Controller
{
    public function edit(Request $request, $id)
    {
        $rep = Rep::find($id);

        if (!$rep) {
            return redirect()->back()->withErrors(['rep' => 'Element non trouvé.']);
        }

        $validatedData = $request->validate([
            'weight' => 'required|numeric',
            'reps' => 'required|integer',
        ]);

        $rep->update($validatedData);

        return redirect()->back()->with(['success.details' => 'Modifié avec succès !']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'serie_id' => 'required|exists:series,id',
            'reps' => 'required|integer',
            'weight' => 'required|integer',
        ]);

        Rep::create($validatedData);
        return redirect()->back()->with(['success.details' => 'Répétition ajoutée avec succès !']);
    }

    public function destroy($id)
    {
        $rep = Rep::find($id);

        if (!$rep) {
            return redirect()->back()->withErrors(['rep' => 'Element non trouvé.']);
        }

        $rep->delete();

        return redirect()->back()->with(['success.details' => 'Supprimé avec succès !']);
    }
}

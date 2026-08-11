<?php

namespace App\Http\Controllers;

use App\Models\Matiere;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MatiereController extends Controller
{
    public function index(): View
    {
        $matieres = Matiere::orderBy('libelle')->paginate(10);
        return view('matieres.index', compact('matieres'));
    }

    public function create(): View
    {
        return view('matieres.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'libelle'     => 'required|string|max:100',
            'coefficient' => 'required|integer|min:1|max:10',
            'professeur'  => 'required|string|max:100',
        ]);

        Matiere::create($validated);

        return redirect()->route('matieres.index')
            ->with('success', 'Matière ajoutée avec succès.');
    }

    public function show(Matiere $matiere): View
    {
        $matiere->load('notes.etudiant');
        return view('matieres.show', compact('matiere'));
    }

    public function edit(Matiere $matiere): View
    {
        return view('matieres.edit', compact('matiere'));
    }

    public function update(Request $request, Matiere $matiere): RedirectResponse
    {
        $validated = $request->validate([
            'libelle'     => 'required|string|max:100',
            'coefficient' => 'required|integer|min:1|max:10',
            'professeur'  => 'required|string|max:100',
        ]);

        $matiere->update($validated);

        return redirect()->route('matieres.index')
            ->with('success', 'Matière mise à jour avec succès.');
    }

    public function destroy(Matiere $matiere): RedirectResponse
    {
        $matiere->delete();

        return redirect()->route('matieres.index')
            ->with('success', 'Matière supprimée.');
    }
}

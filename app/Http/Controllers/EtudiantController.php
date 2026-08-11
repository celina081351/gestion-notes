<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EtudiantController extends Controller
{
    public function index(): View
    {
        $etudiants = Etudiant::orderBy('nom')->paginate(10);
        return view('etudiants.index', compact('etudiants'));
    }

    public function create(): View
    {
        return view('etudiants.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nom'            => 'required|string|max:100',
            'prenom'         => 'required|string|max:100',
            'email'          => 'required|email|max:100|unique:etudiants,email',
            'date_naissance' => 'required|date|before:today',
            'classe'         => 'required|string|max:50',
        ]);

        Etudiant::create($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant enregistré avec succès.');
    }

    public function show(Etudiant $etudiant): View
    {
        $etudiant->load('notes.matiere');
        return view('etudiants.show', compact('etudiant'));
    }

    public function edit(Etudiant $etudiant): View
    {
        return view('etudiants.edit', compact('etudiant'));
    }

    public function update(Request $request, Etudiant $etudiant): RedirectResponse
    {
        $validated = $request->validate([
            'nom'            => 'required|string|max:100',
            'prenom'         => 'required|string|max:100',
            'email'          => 'required|email|max:100|unique:etudiants,email,' . $etudiant->id_etudiant . ',id_etudiant',
            'date_naissance' => 'required|date|before:today',
            'classe'         => 'required|string|max:50',
        ]);

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant mis à jour avec succès.');
    }

    public function destroy(Etudiant $etudiant): RedirectResponse
    {
        $etudiant->delete();

        return redirect()->route('etudiants.index')
            ->with('success', 'Étudiant supprimé.');
    }
}

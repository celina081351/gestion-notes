<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\Note;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NoteController extends Controller
{
    public function index(): View
    {
        $notes = Note::with(['etudiant', 'matiere'])->orderByDesc('date_saisie')->paginate(15);
        return view('notes.index', compact('notes'));
    }

    public function create(): View
    {
        $etudiants = Etudiant::orderBy('nom')->get();
        $matieres  = Matiere::orderBy('libelle')->get();
        return view('notes.create', compact('etudiants', 'matieres'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id_etudiant' => 'required|exists:etudiants,id_etudiant',
            'id_matiere'  => 'required|exists:matieres,id_matiere',
            'valeur'      => 'required|numeric|min:0|max:20',
            'date_saisie' => 'required|date',
            'semestre'    => 'required|string|max:20',
        ]);

        Note::create($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Note saisie avec succès.');
    }

    public function show(Note $note): View
    {
        $note->load(['etudiant', 'matiere']);
        return view('notes.show', compact('note'));
    }

    public function edit(Note $note): View
    {
        $etudiants = Etudiant::orderBy('nom')->get();
        $matieres  = Matiere::orderBy('libelle')->get();
        return view('notes.edit', compact('note', 'etudiants', 'matieres'));
    }

    public function update(Request $request, Note $note): RedirectResponse
    {
        $validated = $request->validate([
            'id_etudiant' => 'required|exists:etudiants,id_etudiant',
            'id_matiere'  => 'required|exists:matieres,id_matiere',
            'valeur'      => 'required|numeric|min:0|max:20',
            'date_saisie' => 'required|date',
            'semestre'    => 'required|string|max:20',
        ]);

        $note->update($validated);

        return redirect()->route('notes.index')
            ->with('success', 'Note modifiée avec succès.');
    }

    public function destroy(Note $note): RedirectResponse
    {
        $note->delete();

        return redirect()->route('notes.index')
            ->with('success', 'Note supprimée.');
    }
}

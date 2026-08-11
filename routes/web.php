<?php

use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\MatiereController;
use App\Http\Controllers\NoteController;
use App\Models\Etudiant;
use App\Models\Matiere;
use App\Models\Note;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard', [
        'totalEtudiants' => Etudiant::count(),
        'totalMatieres'  => Matiere::count(),
        'totalNotes'     => Note::count(),
    ]);
})->name('dashboard');

Route::resource('etudiants', EtudiantController::class);
Route::resource('matieres', MatiereController::class);
Route::resource('notes', NoteController::class);

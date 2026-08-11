@extends('layouts.app')

@section('title', 'Notes')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-pencil-fill me-2"></i>Notes</h2>
    <a href="{{ route('notes.create') }}" class="btn btn-warning">
        <i class="bi bi-plus-circle me-1"></i>Saisir une note
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Étudiant</th>
                    <th>Matière</th>
                    <th>Note</th>
                    <th>Semestre</th>
                    <th>Date de saisie</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notes as $note)
                <tr>
                    <td>{{ $note->id_note }}</td>
                    <td>
                        <a href="{{ route('etudiants.show', $note->etudiant) }}" class="text-decoration-none">
                            {{ $note->etudiant->prenom }} {{ $note->etudiant->nom }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('matieres.show', $note->matiere) }}" class="text-decoration-none">
                            {{ $note->matiere->libelle }}
                        </a>
                        <small class="text-muted">(coeff. {{ $note->matiere->coefficient }})</small>
                    </td>
                    <td>
                        <span class="badge fs-6 bg-{{ $note->valeur >= 10 ? 'success' : 'danger' }}">
                            {{ $note->valeur }}/20
                        </span>
                    </td>
                    <td>{{ $note->semestre }}</td>
                    <td>{{ $note->date_saisie->format('d/m/Y') }}</td>
                    <td class="text-end">
                        <a href="{{ route('notes.edit', $note) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cette note ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Aucune note saisie.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $notes->links() }}</div>
@endsection

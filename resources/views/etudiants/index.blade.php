@extends('layouts.app')

@section('title', 'Étudiants')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2><i class="bi bi-people-fill me-2"></i>Étudiants</h2>
    <a href="{{ route('etudiants.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>Nouvel étudiant
    </a>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Classe</th>
                    <th>Date de naissance</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($etudiants as $etudiant)
                <tr>
                    <td>{{ $etudiant->id_etudiant }}</td>
                    <td>{{ $etudiant->nom }}</td>
                    <td>{{ $etudiant->prenom }}</td>
                    <td>{{ $etudiant->email }}</td>
                    <td><span class="badge bg-secondary">{{ $etudiant->classe }}</span></td>
                    <td>{{ $etudiant->date_naissance->format('d/m/Y') }}</td>
                    <td class="text-end">
                        <a href="{{ route('etudiants.show', $etudiant) }}" class="btn btn-sm btn-outline-info">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('etudiants.edit', $etudiant) }}" class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('etudiants.destroy', $etudiant) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Supprimer cet étudiant ?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center text-muted py-4">Aucun étudiant enregistré.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">{{ $etudiants->links() }}</div>
@endsection

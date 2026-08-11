@extends('layouts.app')

@section('title', 'Modifier matière')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <i class="bi bi-pencil-fill me-2"></i>Modifier : {{ $matiere->libelle }}
            </div>
            <div class="card-body">
                <form action="{{ route('matieres.update', $matiere) }}" method="POST">
                    @csrf @method('PUT')
                    @include('matieres._form')
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-warning">
                            <i class="bi bi-save me-1"></i>Mettre à jour
                        </button>
                        <a href="{{ route('matieres.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

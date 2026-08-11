@extends('layouts.app')

@section('title', 'Nouvel étudiant')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-person-plus-fill me-2"></i>Enregistrer un étudiant
            </div>
            <div class="card-body">
                <form action="{{ route('etudiants.store') }}" method="POST">
                    @csrf
                    @include('etudiants._form')
                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i>Enregistrer
                        </button>
                        <a href="{{ route('etudiants.index') }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

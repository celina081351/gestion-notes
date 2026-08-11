<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Étudiant <span class="text-danger">*</span></label>
        <select name="id_etudiant" class="form-select @error('id_etudiant') is-invalid @enderror" required>
            <option value="">-- Sélectionner --</option>
            @foreach($etudiants as $e)
            <option value="{{ $e->id_etudiant }}"
                {{ old('id_etudiant', $note->id_etudiant ?? '') == $e->id_etudiant ? 'selected' : '' }}>
                {{ $e->prenom }} {{ $e->nom }} — {{ $e->classe }}
            </option>
            @endforeach
        </select>
        @error('id_etudiant')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Matière <span class="text-danger">*</span></label>
        <select name="id_matiere" class="form-select @error('id_matiere') is-invalid @enderror" required>
            <option value="">-- Sélectionner --</option>
            @foreach($matieres as $m)
            <option value="{{ $m->id_matiere }}"
                {{ old('id_matiere', $note->id_matiere ?? '') == $m->id_matiere ? 'selected' : '' }}>
                {{ $m->libelle }} (coeff. {{ $m->coefficient }})
            </option>
            @endforeach
        </select>
        @error('id_matiere')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Note (/20) <span class="text-danger">*</span></label>
        <input type="number" name="valeur" step="0.25" min="0" max="20"
               class="form-control @error('valeur') is-invalid @enderror"
               value="{{ old('valeur', $note->valeur ?? '') }}" required>
        @error('valeur')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Semestre <span class="text-danger">*</span></label>
        <select name="semestre" class="form-select @error('semestre') is-invalid @enderror" required>
            @foreach(['S1','S2','S3','S4','S5','S6'] as $s)
            <option value="{{ $s }}" {{ old('semestre', $note->semestre ?? '') == $s ? 'selected' : '' }}>
                {{ $s }}
            </option>
            @endforeach
        </select>
        @error('semestre')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Date de saisie <span class="text-danger">*</span></label>
        <input type="date" name="date_saisie" class="form-control @error('date_saisie') is-invalid @enderror"
               value="{{ old('date_saisie', isset($note) ? $note->date_saisie->format('Y-m-d') : date('Y-m-d')) }}" required>
        @error('date_saisie')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

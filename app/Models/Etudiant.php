<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Etudiant extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_etudiant';

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'date_naissance',
        'classe',
    ];

    protected $casts = [
        'date_naissance' => 'date',
    ];

    public function notes(): HasMany
    {
        return $this->hasMany(Note::class, 'id_etudiant', 'id_etudiant');
    }

    public function getMoyenneAttribute(): float
    {
        $notes = $this->notes()->with('matiere')->get();
        if ($notes->isEmpty()) {
            return 0.0;
        }
        $totalCoeff = $notes->sum(fn($n) => $n->matiere->coefficient);
        if ($totalCoeff === 0) {
            return 0.0;
        }
        $somme = $notes->sum(fn($n) => $n->valeur * $n->matiere->coefficient);
        return round($somme / $totalCoeff, 2);
    }
}

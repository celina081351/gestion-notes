<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Note extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_note';

    protected $fillable = [
        'id_etudiant',
        'id_matiere',
        'valeur',
        'date_saisie',
        'semestre',
    ];

    protected $casts = [
        'date_saisie' => 'date',
        'valeur'      => 'float',
    ];

    public function etudiant(): BelongsTo
    {
        return $this->belongsTo(Etudiant::class, 'id_etudiant', 'id_etudiant');
    }

    public function matiere(): BelongsTo
    {
        return $this->belongsTo(Matiere::class, 'id_matiere', 'id_matiere');
    }
}

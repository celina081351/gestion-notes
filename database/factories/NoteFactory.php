<?php

namespace Database\Factories;

use App\Models\Etudiant;
use App\Models\Matiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_etudiant' => Etudiant::factory(),
            'id_matiere'  => Matiere::factory(),
            'valeur'      => fake()->randomFloat(2, 0, 20),
            'date_saisie' => fake()->dateTimeThisYear()->format('Y-m-d'),
            'semestre'    => fake()->randomElement(['S1', 'S2', 'S3', 'S4', 'S5', 'S6']),
        ];
    }
}

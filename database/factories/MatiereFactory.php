<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MatiereFactory extends Factory
{
    public function definition(): array
    {
        $matieres = [
            'Algorithmique', 'Bases de données', 'Réseaux informatiques',
            'Développement web', 'Mathématiques', 'Système d\'exploitation',
        ];

        return [
            'libelle'     => fake()->unique()->randomElement($matieres),
            'coefficient' => fake()->numberBetween(1, 5),
            'professeur'  => 'Dr. ' . fake()->lastName(),
        ];
    }
}

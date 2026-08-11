<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nom'            => fake()->lastName(),
            'prenom'         => fake()->firstName(),
            'email'          => fake()->unique()->safeEmail(),
            'date_naissance' => fake()->dateTimeBetween('-30 years', '-18 years')->format('Y-m-d'),
            'classe'         => fake()->randomElement(['L1 INFO', 'L2 INFO', 'L3 INFO', 'M1 INFO', 'M2 INFO']),
        ];
    }
}

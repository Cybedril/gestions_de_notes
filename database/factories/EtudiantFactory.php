<?php

namespace Database\Factories;

use App\Models\Etudiant;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    protected $model = Etudiant::class;

    public function definition()
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'matricule' => $this->faker->unique()->numberBetween(1000, 9999),
            'date_naissance' => $this->faker->date(),
            'sexe' => $this->faker->randomElement(['M', 'F']),
        ];
    }
}

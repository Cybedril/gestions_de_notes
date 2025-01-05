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
            'numero_etudiant' => $this->faker->unique()->randomNumber(),  // Ajouter un numéro étudiant
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'matricule' => $this->faker->unique()->randomNumber(),
            'date_naissance' => $this->faker->date(),
            'sexe' => $this->faker->randomElement(['M', 'F']),
        ];
    }
}

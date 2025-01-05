<?php

// database/factories/UEFactory.php
namespace Database\Factories;

use App\Models\UE;
use Illuminate\Database\Eloquent\Factories\Factory;

class UEFactory extends Factory
{
    protected $model = UE::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word, // Code unique pour l'UE
            'nom' => $this->faker->word,             // Nom de l'UE
            'credits_ects' => $this->faker->numberBetween(1, 10), // Nombre de crédits
            'semestre' => $this->faker->numberBetween(1, 2),      // Semestre (1 ou 2)
        ];
    }
}

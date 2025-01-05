<?php

namespace Database\Factories;

use App\Models\EC;
use App\Models\UE; // Assurez-vous d'importer le modèle UE pour la relation
use Illuminate\Database\Eloquent\Factories\Factory;

class ECFactory extends Factory
{
    protected $model = EC::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word,
            'nom' => $this->faker->word,
            'coefficient' => $this->faker->numberBetween(1, 10),
            'ue_id' => UE::factory(), // Crée une UE associée
        ];
    }
}

<?php

// database/factories/ECFactory.php
// database/factories/ECFactory.php
namespace Database\Factories;

use App\Models\EC;
use App\Models\UE;
use Illuminate\Database\Eloquent\Factories\Factory;

class ECFactory extends Factory
{
    protected $model = EC::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word,
            'nom' => $this->faker->word,
            'coefficient' => $this->faker->numberBetween(1, 5),
            'ue_id' => UE::factory(),  // Référence à l'UE
        ];
    }
}

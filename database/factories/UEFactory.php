<?php

namespace Database\Factories;

use App\Models\UE;
use Illuminate\Database\Eloquent\Factories\Factory;

class UEFactory extends Factory
{
    protected $model = UE::class;

    public function definition()
    {
        return [
            'code' => $this->faker->word,
            'credits_ects' => $this->faker->numberBetween(1, 30),
            'semestre' => $this->faker->numberBetween(1, 6),  // Semestre entre 1 et 6
            'nom' => $this->faker->word,
        ];
    }
}

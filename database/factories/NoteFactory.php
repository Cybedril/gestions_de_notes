<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    protected $model = \App\Models\Note::class;

    public function definition()
    {
        return [
            'etudiant_id' => \App\Models\Etudiant::factory(),
            'ec_id' => \App\Models\EC::factory(),
            'ue_id' => \App\Models\UE::factory(),
            'note' => $this->faker->randomFloat(2, 0, 20),
            'session' => $this->faker->randomElement(['normale', 'rattrapage']),
            'date_evaluation' => $this->faker->date(),
        ];
    }

    
}

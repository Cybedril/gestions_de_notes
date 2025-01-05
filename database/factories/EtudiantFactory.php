use Faker\Generator as Faker;

$factory->define(App\Models\Etudiant::class, function (Faker $faker) {
    return [
        'numero_etudiant' => $faker->unique()->numberBetween(1000, 9999),
        'nom' => $faker->lastName,
        'prenom' => $faker->firstName,
        'niveau' => $faker->randomElement(['L1', 'L2', 'L3']),
    ];
});

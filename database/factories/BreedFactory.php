<?php

/** @noinspection PhpMissingFieldTypeInspection */

namespace Database\Factories;

use App\Models\Breed;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BreedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Breed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $animal_types = Breed::getAvailableAnimalypes();
        return [
            'animal_type' => $animal_types[array_rand($animal_types)],
            'name' => $this->faker->word(),
            'temperament' => implode(',', $this->faker->words()),
            'alternative_names' => implode(',', $this->faker->words()),
            'life_span' => random_int(5, 10) .' - ' . random_int(10, 15),
            'origin' => $this->faker->country,
            'wikipedia_url' => $this->faker->url,
            'country_code' => $this->faker->countryCode,
            'description' => $this->faker->sentence(),
            'favourite' => random_int(0, 1)
        ];
    }
}

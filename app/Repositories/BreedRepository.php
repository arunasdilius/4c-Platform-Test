<?php

namespace App\Repositories;

use App\Models\Breed;
use Fcp\AnimalBreedsSearch\Facades\AnimalBreedsSearch;
use Illuminate\Support\Collection;

/**
 * Class Breed
 * @package App\Models
 */
class BreedRepository
{
    /**
     * @param string $animal_type
     * @param string $name
     * @return Collection
     */
    public function getByAnimalTypeAndName(string $animal_type, string $name): Collection
    {
        return Breed::where('animal_type', $animal_type)
            ->where('name', 'like', '%' . $name . '%')
            ->get();
    }

    /**
     * @param string $animal_type
     * @param $name
     * @return Collection
     */
    public function getFromAnimalBreedsService(string $animal_type, $name): Collection
    {
        $results = AnimalBreedsSearch::getByAnimalTypeAndName($animal_type, $name);
        foreach ($results as $attributes) {
            $this->create(
                $animal_type,
                $attributes['name'],
                $attributes['temperament'],
                $attributes['alt_names'],
                $attributes['life_span'],
                $attributes['origin'],
                $attributes['wikipedia_url'],
                $attributes['country_code'],
                $attributes['description'],
                false
            );
        }
        return $this->getByAnimalTypeAndName($animal_type, $name);
    }

    /**
     * @param string $animal_type
     * @param string $name
     * @param string $temperament
     * @param string $alternative_names
     * @param string $life_span
     * @param string $origin
     * @param string $wikipedia_url
     * @param string $country_code
     * @param string $description
     * @param bool $favourite
     * @return Breed
     * @internal param array $attributes
     */
    public function create(
        string $animal_type,
        string $name,
        string $temperament,
        string $alternative_names,
        string $life_span,
        string $origin,
        string $wikipedia_url,
        string $country_code,
        string $description,
        bool $favourite
    ): Breed
    {
        return $this->update(
            new Breed(),
            $animal_type,
            $name,
            $temperament,
            $alternative_names,
            $life_span,
            $origin,
            $wikipedia_url,
            $country_code,
            $description,
            $favourite
        );
    }

    /**
     * @param Breed $breed
     * @param string $animal_type
     * @param string $name
     * @param string $temperament
     * @param string $alternative_names
     * @param string $life_span
     * @param string $origin
     * @param string $wikipedia_url
     * @param string $country_code
     * @param string $description
     * @param bool $favourite
     * @return Breed
     */
    public function update(
        Breed $breed,
        string $animal_type,
        string $name,
        string $temperament,
        string $alternative_names,
        string $life_span,
        string $origin,
        string $wikipedia_url,
        string $country_code,
        string $description,
        bool $favourite
    ): Breed
    {
        $breed->animal_type = $animal_type;
        $breed->name = $name;
        $breed->temperament = $temperament;
        $breed->alternative_names = $alternative_names;
        $breed->life_span = $life_span;
        $breed->origin = $origin;
        $breed->wikipedia_url = $wikipedia_url;
        $breed->country_code = $country_code;
        $breed->description = $description;
        $breed->favourite = $favourite;
        $breed->save();
        return $breed;
    }
}

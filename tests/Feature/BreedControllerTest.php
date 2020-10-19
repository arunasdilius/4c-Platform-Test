<?php

namespace Tests\Feature;

use App\Models\Breed;
use Fcp\AnimalBreedsSearch\Facades\AnimalBreedsSearch;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class ExampleTest
 *
 * @package Tests\Feature
 */
class BreedControllerTest extends TestCase
{
    use WithFaker;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testValidateRequiredParamsRequest(): void
    {
        $this->actingAsUser()
            ->get(route('breeds.index'))
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'animal_type',
                    'name'
                ]
            ]);
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testValidateAnimalTypeParameter(): void
    {
        $this->actingAsUser()
            ->get(route('breeds.index',
                [
                    'animal_type' => 'panda',
                    'name' => 'short'
                ]
            ))
            ->assertStatus(422)
            ->assertJsonStructure([
                'errors' => [
                    'animal_type'
                ]
            ]);
    }

    public function testWillReceiveBreedsFromDatabase(): void
    {
        // @todo sqllite does not have transactions and bd rollback does not execute for each test
        // delete all existing records to prepare env
        Breed::query()->delete();
        Breed::factory()->count(10)->create();
        $name = 'Shorthair';
        $total = 2;
        Breed::factory(['name' => $name, 'animal_type' => Breed::TYPE_CAT])->count($total)->create();
        $response = $this->actingAsUser()
            ->get(route('breeds.index',
                [
                    'animal_type' => Breed::TYPE_CAT,
                    'name' => $name
                ]
            ));
        $response->assertStatus(200);
        $this->assertEquals($total, count($response->decodeResponseJson()));
    }

    public function testWillReceiveBreedsFromApi(): void
    {
        // @todo sqllite does not have transactions and bd rollback does not execute for each test
        // delete all existing records to prepare env
        $name = 'Shorthair';
        Breed::query()->delete();
        AnimalBreedsSearch::shouldReceive('getByAnimalTypeAndName')
            ->once()
            ->andReturn([
                [
                    "name" => "Colorpoint Shorthair",
                    "temperament" => "Affectionate, Intelligent, Playful, Social",
                    "origin" => "United States",
                    "country_code" => "US",
                    "description" => "Colorpoint Shorthairs are an affectionate breed, devoted and loyal to their people. Sensitive to their owner’s moods, Colorpoints are more than happy to sit at your side or on your lap and purr words of encouragement on a bad day. They will constantly seek out your lap whenever it is open and in the moments when your lap is preoccupied they will stretch out in sunny spots on the ground.",
                    "life_span" => "12 - 16",
                    "alt_names" => "",
                    "wikipedia_url" => "https://en.wikipedia.org/wiki/Colorpoint_Shorthair"
                ],
                [
                    "name" => "Exotic Shorthair",
                    "temperament" => "Affectionate, Sweet, Loyal, Quiet, Peaceful",
                    "origin" => "United States",
                    "country_code" => "US",
                    "description" => "The Exotic Shorthair is a gentle friendly cat that has the same personality as the Persian. They love having fun, don’t mind the company of other cats and dogs, also love to curl up for a sleep in a safe place. Exotics love their own people, but around strangers they are cautious at first. Given time, they usually warm up to visitors.",
                    "life_span" => "12 - 15",
                    "alt_names" => "Exotic",
                    "wikipedia_url" => "https://en.wikipedia.org/wiki/Colorpoint_Shorthair"
                ]
            ]);
        $response = $this->actingAsUser()
            ->get(route('breeds.index',
                [
                    'animal_type' => Breed::TYPE_CAT,
                    'name' => $name
                ]
            ));
        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'animal_type',
                    'name',
                    'temperament',
                    'alternative_names',
                    'life_span',
                    'origin',
                    'wikipedia_url',
                    'country_code',
                    'description',
                    'favourite',
                    'created_at',
                    'updated_at',
                ]
            ]);
        $this->assertEquals(2, count($response->decodeResponseJson()));
        $breeds_in_database = Breed::query()->count();
        $this->assertEquals(2, $breeds_in_database);
    }

    public function testWillReturnRecordById()
    {
        $breed = Breed::factory()->create();
        $new_attributes = [
            "name" => $this->faker()->word,
            "temperament" => $this->faker()->sentence(),
            "origin" => $this->faker()->country,
            "country_code" => $this->faker()->countryCode,
            "description" => $this->faker()->sentences(3, true),
            "life_span" => random_int(5, 10) . " - " . random_int(11, 20),
            "alternative_names" => $this->faker()->words(3, true),
            "wikipedia_url" => $this->faker()->url,
            "favourite" => random_int(0, 1)
        ];
        $response = $this->actingAsUser()
            ->put(
                route('breeds.update', ['breed' => $breed->getKey()]),
                $new_attributes
            );
        $response->assertStatus(200);
        $results = $response->decodeResponseJson();
        $this->assertEquals($new_attributes["name"], $results["name"]);
        $this->assertEquals($new_attributes["temperament"], $results["temperament"]);
        $this->assertEquals($new_attributes["origin"], $results["origin"]);
        $this->assertEquals($new_attributes["country_code"], $results["country_code"]);
        $this->assertEquals($new_attributes["description"], $results["description"]);
        $this->assertEquals($new_attributes["life_span"], $results["life_span"]);
        $this->assertEquals($new_attributes["alternative_names"], $results["alternative_names"]);
        $this->assertEquals($new_attributes["wikipedia_url"], $results["wikipedia_url"]);
        $this->assertEquals($new_attributes["favourite"], $results["favourite"]);
    }
}

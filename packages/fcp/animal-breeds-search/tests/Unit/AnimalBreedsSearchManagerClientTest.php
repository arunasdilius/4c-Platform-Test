<?php

namespace Fcp\AnimalBreedsSearch\Tests\Unit;

use Fcp\AnimalBreedsSearch\AnimalBreedsSearchClient;
use Fcp\AnimalBreedsSearch\Tests\TestCase;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

/**
 * Created by PhpStorm.
 * User: arunas
 * Date: 19/10/20
 * Time: 12:24
 */
class AnimalBreedsSearchManagerClientTest extends TestCase
{
    public function testWillReturnJson()
    {
        Http::fake([
            '*' => Http::sequence()
                ->push(
                    [
                        [
                            "adaptability" => 5,
                            "affection_level" => 5,
                            "alt_names" => "Domestic Shorthair",
                            "cfa_url" => "http://cfa.org/Breeds/BreedsAB/AmericanShorthair.aspx",
                            "child_friendly" => 4,
                            "country_code" => "US",
                            "country_codes" => "US",
                            "description" => "The American Shorthair is known for its longevity, robust health, good looks, sweet personality, and amiability with children, dogs, and other pets.",
                            "dog_friendly" => 5,
                            "energy_level" => 3,
                            "experimental" => 0,
                            "grooming" => 1,
                            "hairless" => 0,
                            "health_issues" => 3,
                            "hypoallergenic" => 0,
                            "id" => "asho",
                            "indoor" => 0,
                            "intelligence" => 3,
                            "lap" => 1,
                            "life_span" => "15 - 17",
                            "name" => "American Shorthair",
                            "natural" => 1,
                            "origin" => "United States",
                            "rare" => 0,
                            "rex" => 0,
                            "shedding_level" => 3,
                            "short_legs" => 0,
                            "social_needs" => 4,
                            "stranger_friendly" => 3,
                            "suppressed_tail" => 0,
                            "temperament" => "Active, Curious, Easy Going, Playful, Calm",
                            "vcahospitals_url" => "https://vcahospitals.com/know-your-pet/cat-breeds/american-shorthair",
                            "vetstreet_url" => "http://www.vetstreet.com/cats/american-shorthair",
                            "vocalisation" => 3,
                            "weight" => [
                                "imperial" => "8 - 15",
                                "metric" => "4 - 7"
                            ],
                            "wikipedia_url" => "https://en.wikipedia.org/wiki/American_Shorthair"
                        ]
                    ], 200)
        ]);
        $client = $this->createMock(AnimalBreedsSearchClient::class);
        $response = $client->getJsonByName('short');
        $this->assertTrue(is_array($response));
    }
}
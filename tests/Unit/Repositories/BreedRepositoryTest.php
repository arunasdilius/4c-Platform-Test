<?php

namespace Tests\Unit;

use App\Models\Breed;
use App\Repositories\BreedRepository;
use Tests\TestCase;

/**
 * Class ExampleTest
 *
 * @package Tests\Unit
 */
class BreedRepositoryTest extends TestCase
{
    /**
     * Test if can construct Breed class
     *
     * @return void
     */
    public function testWillRetrieveOneRecord(): void
    {
        Breed::factory()->count(10)->create();
        $name = 'Shorthair';
        $total = 2;
        Breed::factory(['name' => $name, 'animal_type' => Breed::TYPE_CAT])->count($total)->create();
        $breeds = (new BreedRepository())->getByAnimalTypeAndName(Breed::TYPE_CAT, $name);
        $this->assertEquals($total, $breeds->count());
    }
}

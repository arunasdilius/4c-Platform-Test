<?php

namespace Tests\Unit;

use App\Models\Breed;
use Tests\TestCase;

/**
 * Class ExampleTest
 *
 * @package Tests\Unit
 */
class BreedTest extends TestCase
{
    /**
     * Test if can construct Breed class
     *
     * @return void
     */
    public function testCanConstructClass(): void
    {
        $this->assertNotNull(new Breed());
    }
}

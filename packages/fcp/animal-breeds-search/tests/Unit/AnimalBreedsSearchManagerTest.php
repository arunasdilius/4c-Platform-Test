<?php

namespace Fcp\AnimalBreedsSearch\Tests\Unit;

use Fcp\AnimalBreedsSearch\AnimalBreedsSearchClient;
use Fcp\AnimalBreedsSearch\AnimalBreedsSearchManager;
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
class AnimalBreedsSearchManagerTest extends TestCase
{

    public function testWillThrowExceptionForMissingServiceDriver()
    {
        $app = $this->createApplication();
        $app['config']['animal-breeds-search.service'] = 'placeholder';
        $this->expectException(\InvalidArgumentException::class);
        new AnimalBreedsSearchManager($app);
    }

    public function willResolveClient()
    {
        new AnimalBreedsSearchManager($this->createApplication());
        $client = $this->getClient();
        $this->assertInstanceOf(AnimalBreedsSearchClient::class, $client);
    }
}
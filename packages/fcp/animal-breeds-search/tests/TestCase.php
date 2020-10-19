<?php

namespace Fcp\AnimalBreedsSearch\Tests;

use Fcp\AnimalBreedsSearch\AnimalBreedsSearchServiceProvider;
use Fcp\AnimalBreedsSearch\Facades\AnimalBreedsSearch;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

/**
 * Class TestCase
 *
 * @package Fcp\AnimalBreedsSearch\Tests
 */
class TestCase extends OrchestraTestCase
{
    /**
     * Setup the service provider
     *
     * @param Application $app
     *
     * @noinspection PhpMissingParamTypeInspection
     * @return array|string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            AnimalBreedsSearchServiceProvider::class,
        ];
    }

    /**
     * Set up any facades we use
     *
     * @param Application $app
     *
     * @noinspection PhpMissingParamTypeInspection
     * @return array|string[]
     */
    protected function getPackageAliases($app): array
    {
        return [
            "AnimalBreedsSearch" => AnimalBreedsSearch::class,
        ];
    }
}

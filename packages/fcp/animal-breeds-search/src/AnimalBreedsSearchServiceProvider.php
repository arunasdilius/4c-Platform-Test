<?php

namespace Fcp\AnimalBreedsSearch;

use Fcp\AnimalBreedsSearch\AnimalBreedsSearchManager;
use Fcp\AnimalBreedsSearch\Console\Commands\GetByAnimalTypeAndNameCommand;
use Illuminate\Support\ServiceProvider;

/**
 * Class AnimalBreedsSearchServiceProvider
 *
 * @package Fcp\AnimalBreedsSearch
 */
class AnimalBreedsSearchServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/animal-breeds-search.php', 'animal-breeds-search');

        // Register the animal breed search service here

        $this->app->singleton('animal-breeds-search', function ($app) {
            return new AnimalBreedsSearchManager($app);
        });
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publish the translation files.

        // Publish the configuration file.

        // Registering package commands.
        $this->commands([
            GetByAnimalTypeAndNameCommand::class
        ]);
    }
}

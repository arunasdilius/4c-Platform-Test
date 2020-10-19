<?php

namespace Tests\Traits;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Artisan;
use Mockery;

/**
 * Trait CreatesApplication
 *
 * @package Tests\Traits
 */
trait CreatesApplication
{
    private static Application $configurationApp;

    private static bool $initialised = false;

    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication(): Application
    {
        return self::initialize();
    }

    /**
     * Initialise the app environment
     *
     * @return Application
     */
    public static function initialize(): Application
    {
        if (!self::$initialised) {
            $app = require __DIR__ . '/../../bootstrap/app.php';

            $app->make(Kernel::class)->bootstrap();

            Artisan::call('migrate --seed');
            Artisan::call(
                'db:seed',
                ['--class' => 'TestDataSeeder']
            );

            self::$configurationApp = $app;
            self::$initialised = true;

            return $app;
        }

        return self::$configurationApp;
    }

    /**
     * Override standard teardown to clear down application environment
     */
    protected function tearDown(): void
    {
        if (self::$initialised) {
            foreach ($this->beforeApplicationDestroyedCallbacks as $callback) {
                $callback();
            }
        }

        $this->setUpHasRun = false;

        if (property_exists($this, 'serverVariables')) {
            $this->serverVariables = [];
        }

        if (class_exists('Mockery')) {
            Mockery::close();
        }

        $this->afterApplicationCreatedCallbacks = [];
        $this->beforeApplicationDestroyedCallbacks = [];
    }
}

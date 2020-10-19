<?php

namespace Fcp\AnimalBreedsSearch;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

/**
 * Created by PhpStorm.
 * User: arunas
 * Date: 19/10/20
 * Time: 12:24
 */
class AnimalBreedsSearchManager
{
    /**
     * @var AnimalBreedsSearchClient
     */
    protected $client;
    /**
     * @var Application
     */
    private $app;

    /**
     * AnimalBreedSearchClient constructor.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $service = $this->getConfig('service');
        $this->client = $this->resolveClient($service);
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function getConfig($key)
    {
        return $this->app['config']["animal-breeds-search.{$key}"];
    }

    public function getByAnimalTypeAndName(string $animal_type, string $name): array
    {
        $service_name = $this->resolveServiceName($animal_type);
        $this->client = $this->resolveClient($service_name);
        return $this->client->getJsonByName($name);
    }

    /**
     * @param string $service
     * @return AnimalBreedsSearchClient
     */
    private function resolveClient(string $service): AnimalBreedsSearchClient
    {
        $service_configuration = $this->getConfig('services.' . strtolower($service));
        if ($service_configuration === null || empty($service_configuration)) {
            throw new \InvalidArgumentException("Service [$service] is not supported.");
        }
        return new AnimalBreedsSearchClient(
            $service_configuration['api_key'],
            $service_configuration['endpoint'],
            $service_configuration['version'],
            $this->getConfig('timeout')
        );
    }

    /**
     * @param string $animal_type
     * @return string
     */
    public function resolveServiceName(string $animal_type): string
    {
        return 'the' . strtolower($animal_type) . 'api';
    }
}
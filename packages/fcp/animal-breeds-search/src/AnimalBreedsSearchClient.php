<?php

namespace Fcp\AnimalBreedsSearch;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

/**
 * Created by PhpStorm.
 * User: arunas
 * Date: 19/10/20
 * Time: 12:24
 */
class AnimalBreedsSearchClient
{
    /**
     * @var string
     */
    protected $api_key;
    /**
     * @var string
     */
    protected $endpoint;
    /**
     * @var string
     */
    protected $version;
    /**
     * @var int
     */
    protected $timeout;

    /**
     * AnimalBreedSearchClient constructor.
     * @param string $api_key
     * @param string $endpoint
     * @param string $version
     * @param int $timeout
     */
    public function __construct(string $api_key, string $endpoint, string $version, int $timeout)
    {
        $this->api_key = $api_key;
        $this->endpoint = $endpoint;
        $this->version = $version;
        $this->timeout = $timeout;
    }

    /**
     *
     */
    public function getByName($name): Response
    {
        return Http::withHeaders(['x-api-key' => $this->api_key])
            ->get($this->endpoint . '/' . $this->version . '/breeds/search', [
                'q' => $name
            ]);
    }

    /**
     * @param $name
     * @return array
     */
    public function getJsonByName($name): array
    {
        return $this->getByName($name)->json();
    }
}
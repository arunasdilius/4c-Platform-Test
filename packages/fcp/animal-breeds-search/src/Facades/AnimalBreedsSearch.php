<?php

namespace Fcp\AnimalBreedsSearch\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class AnimalBreedsSearchService
 * @package Fcp\AnimalBreedsSearch
 */
class AnimalBreedsSearch extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'animal-breeds-search';
    }
}

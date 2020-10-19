<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListBreedsRequest;
use App\Http\Requests\UpdateBreedsRequest;
use App\Models\Breed;
use App\Repositories\BreedRepository;
use Illuminate\Http\{
    JsonResponse,
};

/**
 * Class BreedController
 *
 * @package App\Http\Controllers\Api
 */
class BreedController extends Controller
{
    /**
     * @var BreedRepository
     */
    private $breedRepository;

    /**
     * BreedController constructor.
     * @param BreedRepository $breedRepository
     */
    public function __construct(
        BreedRepository $breedRepository
    )
    {
        $this->breedRepository = $breedRepository;
    }

    /**
     * Get the authenticated user
     *
     * @param ListBreedsRequest|Request $request
     * @return JsonResponse
     */
    public function index(ListBreedsRequest $request): JsonResponse
    {
        $animal_type = $request->query('animal_type');
        $name = $request->query('name');
        $breeds = $this->breedRepository->getByAnimalTypeAndName($animal_type, $name);
        if ($breeds->count() == 0) {
            $breeds = $this->breedRepository->getFromAnimalBreedsService($animal_type, $name);
        }
        return response()->json($breeds);
    }

    /**
     * @param UpdateBreedsRequest|Request $request
     * @param Breed $breed
     * @return JsonResponse
     */
    public function update(UpdateBreedsRequest $request, Breed $breed): JsonResponse
    {
        // We could use Eloquent's fill but we want all atrributes to be transparent in code
        $breed = $this->breedRepository->update(
            $breed,
            $request->has('animal_type') ? $request->get('animal_type') : $breed->animal_type,
            $request->has('name') ? $request->get('name') : $breed->name,
            $request->has('temperament') ? $request->get('temperament') : $breed->temperament,
            $request->has('alternative_names') ? $request->get('alternative_names') : $breed->alternative_names,
            $request->has('life_span') ? $request->get('life_span') : $breed->life_span,
            $request->has('origin') ? $request->get('origin') : $breed->origin,
            $request->has('wikipedia_url') ? $request->get('wikipedia_url') : $breed->wikipedia_url,
            $request->has('country_code') ? $request->get('country_code') : $breed->country_code,
            $request->has('description') ? $request->get('description') : $breed->description,
            $request->has('favourite') ? $request->get('favourite') : $breed->favourite
        );
        return response()->json($breed);
    }
}
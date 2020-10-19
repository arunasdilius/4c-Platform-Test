<?php

namespace App\Http\Requests;

use App\Http\Request;
use App\Models\Breed;
use Illuminate\Validation\Rule;

/**
 * Class UserRequest
 *
 * @package App\Http\Requests
 *
 * @property string $name
 * @property string $email
 * @property string $password
 */
class UpdateBreedsRequest extends Request
{
    public function rules(): array
    {
        return [
            'animal_type' => [
                'nullable',
                Rule::in(Breed::getAvailableAnimalypes())
            ],
            'name' => 'nullable|string',
            'temperament' => 'nullable|string',
            'alternative_names' => 'nullable|string',
            'life_span' => 'nullable|string',
            'origin' => 'nullable|string',
            'wikipedia_url' => 'nullable|string',
            'country_code' => 'nullable|string',
            'description' => 'nullable|string',
            'favourite' => 'nullable|boolean',
        ];
    }

    public function messages()
    {
        $messages = parent::messages();
        $messages ['animal_type.in'] = "Animal type must be one of the following: " . implode(Breed::getAvailableAnimalypes());
        return $messages;
    }
}

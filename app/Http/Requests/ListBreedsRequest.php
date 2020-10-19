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
class ListBreedsRequest extends Request
{
    public function rules(): array
    {
        return [
            'animal_type' => [
                'required',
                Rule::in(Breed::getAvailableAnimalypes())
            ],
            'name' => [
                'required'
            ]
        ];
    }

    public function messages()
    {
        $messages = parent::messages();
        $messages ['animal_type.in'] = "Animal type must be one of the following: " . implode(Breed::getAvailableAnimalypes());
        return $messages;
    }
}

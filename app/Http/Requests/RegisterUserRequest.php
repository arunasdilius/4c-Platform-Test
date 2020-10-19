<?php

namespace App\Http\Requests;

use App\Http\Request;

/**
 * Class UserRequest
 *
 * @package App\Http\Requests
 *
 * @property string $name
 * @property string $email
 * @property string $password
 */
class RegisterUserRequest extends Request
{
    public function rules(): array
    {
        return [
            'name'      => 'required|string:min:3',
            'email'     => 'required|email|unique:users',
            'password'  => 'required|string|min:3',
        ];
    }
}

<?php

namespace App\Http\Requests;

use App\Http\Request;

/**
 * Class UserRequest
 *
 * @package App\Http\Requests
 *
 * @property string $email
 * @property string $password
 */
class UserLoginRequest extends Request
{
    public function rules(): array
    {
        return [
            'email'     => 'required|string',
            'password'  => 'required|string',
        ];
    }
}

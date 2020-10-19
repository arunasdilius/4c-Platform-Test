<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\{
    RegisterUserRequest,
    UserLoginRequest
};
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

/**
 * Class AuthController
 *
 * @package App\Http\Controllers\Api
 */
class AuthController extends Controller
{
    /**
     * Register an account
     *
     * @param RegisterUserRequest $request
     *
     * @return JsonResponse
     */
    public function register(RegisterUserRequest $request): JsonResponse
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return $this->response->respond([
            'token' => $user->createToken(config('auth.sanctum_token_name'))->plainTextToken,
            'type'  => 'Bearer'
        ]);
    }

    /**
     * Login Request
     *
     * @param UserLoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(UserLoginRequest $request): JsonResponse
    {
        $data = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($data) && Auth::user() !== null) {
            return $this->response->respond([
                'token' => Auth::user()->createToken(config('auth.sanctum_token_name'))->plainTextToken,
                'type'  => 'Bearer',
            ]);
        }

        return $this->response->unauthorised();
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\{
    JsonResponse,
    Request
};

/**
 * Class UserController
 *
 * @package App\Http\Controllers\Api
 */
class UserController extends Controller
{
    /**
     * Get the authenticated user
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function me(Request $request): JsonResponse
    {
        return $this->response->respond($request->user());
    }
}

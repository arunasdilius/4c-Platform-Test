<?php

namespace App\Http;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * Class BaseResponse
 *
 * @package App\Http
 */
class BaseResponse extends JsonResponse
{
    /**
     * Send a success response with optional message string or body
     *
     * @param mixed $data
     *
     * @param string $status
     *
     * @return JsonResponse
     */
    public function respond($data = null, string $status = Response::HTTP_OK): JsonResponse
    {
        $response = [];

        if (is_string($data)) {
            $response['message'] = $data;
        } elseif ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response, $status);
    }

    /**
     * Returns unauthorised response
     *
     * @return JsonResponse
     */
    public function unauthorised(): JsonResponse
    {
        return response()->json(['unauthorised'], Response::HTTP_UNAUTHORIZED);
    }
}

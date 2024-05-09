<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function createErrorResponse($message, $code): JsonResponse
    {
        return response()->json([
            'error' => [
                'message' => $message,
                'code' => $code,
            ]
        ], $code);
    }
}

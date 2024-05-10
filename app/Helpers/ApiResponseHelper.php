<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponseHelper
{

    public static function success($message, $data = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data,
        ]);
    }

    public static function error($message, $errors = null, $status = 400)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}

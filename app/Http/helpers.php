<?php

if (!function_exists('ApiErrorResponse')) {
    function ApiErrorResponse($message, $key = null)
    {
        if (!is_null($key)) {
            $data = [
                'status' => true,
                'message' => [
                    $key => $message
                ],
                'data' => null,
            ];
        } else {
            $data = [
                'status' => true,
                'message' => [
                    'error' => $message
                ],
                'data' => null,
            ];
        }

        return response()->json($data, 400);
    }
}

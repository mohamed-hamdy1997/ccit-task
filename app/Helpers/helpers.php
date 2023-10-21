<?php

use Illuminate\Support\Facades\Route;

function isActiveRoute($route, $output = "active")
{
    if (Route::currentRouteName() == $route) return $output;
}

function returnResponse($data = null, $massage = [], $errors = [], $statusCode = 200)
{
    if ($data !== null) {
        return response()->json(['data' => $data, 'message' => $massage, 'errors' => is_array($errors) ? $errors : [$errors]], $statusCode);
    }

    return response()->json(['data' => (object) [], 'message' => $massage, 'errors' => is_array($errors) ? $errors : [$errors]], $statusCode);
}

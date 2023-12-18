<?php
/**************************************************************************
 * Copyright (C) don, Inc - All Rights Reserved
 *
 * @file        ApiResponse.php
 * @author      don
 * @site        <donphelix.com>
 * @date        04/08/2023
 */


namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function success($data = null, $message = 'Success', $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    public static function error($message = 'Error', $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}

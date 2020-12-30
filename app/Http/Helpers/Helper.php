<?php

use App\Models\Website\BusinessSettings;

if (!function_exists('JsonResponse')) {
    function JsonResponse($status, $message='', $data=null)
    {
        return response()->json(['status' => $status,'message' => $message, 'data' => $data]);
    }
}

if (!function_exists('generalPagination')) {
    function generalPagination($search = 'general_paginate_count')
    {
        if ($search) {
            $data = BusinessSettings::where('type', $search)->first();
            if ($data) {
                return $data->value;
            }
            return 10;
        }
    }
}

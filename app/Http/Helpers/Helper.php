<?php

use App\Models\Website\BusinessSettings;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

if (!function_exists('JsonResponse')) {
    function JsonResponse($status, $message = '', $data = [])
    {
        return response()->json(['status' => $status, 'message' => $message, 'data' => $data]);
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

if (!function_exists('UploadImage')) {
    function UploadImage($upload, $path, $resizeWidth = null, $resizeHeight = null, $ext = null)
    {
        if (!file_exists($path)) {
            mkdir($path, 755, true);
        }
        if (!$ext) {
            $ext = explode('/', explode(':', substr($upload, 0, strpos($upload, ';')))[1])[1];
        }

        $filename = rand() . time() . '.' . $ext;
        $savePath = $path . '/' . $filename;
        $filePath = env("APP_URL", "http://127.0.0.1:8000/").$path . '/' . $filename;

        $replace = substr($upload, 0, strpos($upload, ',') + 1);

        $image = str_replace($replace, '', $upload);

        $upload = base64_decode(str_replace(' ', '+', $image));

        if ($resizeWidth && $resizeHeight) {
            $image = Image::make($upload)->resize($resizeWidth, $resizeHeight, function ($constraint) {
                $constraint->aspectRatio();
            })->encode($ext, 75);
        } else {
            $image = Image::make($upload)->encode($ext, 75);
        }

        $image->save(public_path($savePath));
        return $filePath;
    }
}
//if (!function_exists('UploadImage')) {
//    function UploadImage($upload, $path, $resizeWidth = null, $resizeHeight = null, $ext = null)
//    {
//        if (!file_exists($path)) {
//            mkdir($path, 755, true);
//        }
//        if (!$ext) {
//            $ext = $upload->getClientOriginalExtension();
//        }
//
//        $filename = rand() . time() . '.' . $ext;
//        $filePath = $path . '/' . $filename;
//
//        if ($resizeWidth && $resizeHeight) {
//            $image = Image::make($upload)->resize($resizeWidth, $resizeHeight, function ($constraint) {
//                $constraint->aspectRatio();
//            })->encode($ext, 75);
//        } else {
//            $image = Image::make($upload)->encode($ext, 75);
//        }
//
//        $image->save(public_path($filePath));
//        return $filePath;
//    }
//}

if (!function_exists('deleteImage')) {
    function deleteImage($path)
    {
        if (file_exists($path)) {
            $delete = File::delete($path);
            if ($delete) return 1;
            else return 0;
        } else return -1;
    }
}

// to get response specific messages
if (!function_exists('getMessage')) {
    function getMessage($model, $action, $status)
    {
        return 'messages';
    }
}

// to get response specific messages
if (!function_exists('getMimesSupport')) {
    function getMimesSupport()
    {
        return 'jpeg,png,jpg,gif';
    }
}

// to get response specific messages
if (!function_exists('getRequiredStatus')) {
    function getRequiredStatus($value)
    {
        if ($value == 'ar') {
            return 'nullable';
        } else {
            return 'required';
        }
    }
}

// to get response specific messages
if (!function_exists('generateMetaTages')) {
    function generateMetaTages($title = null, $desc = null)
    {
        if ($title && $desc) {
            return [
                'meta_title' => $title,
                'meta_description' => substr(strip_tags($desc), 0, 150) . '...',
            ];
        } elseif ($title && !$desc) {
            return [
                'title' => $title,
                'desc' => $title . '...',
            ];
        }
    }
}

// to get response specific messages
if (!function_exists('generateSlug')) {
    function generateSlug($title)
    {
        return strtolower(preg_replace(
            ['/[^\w\s]+/', '/\s+/'],
            ['', '-'],
            $title
        ));
    }
}

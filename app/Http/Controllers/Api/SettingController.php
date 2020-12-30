<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\General\GeneralSettings;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        return response()->json(['status' => 200 , 'data' => GeneralSettings::first()], 200);
    }
}

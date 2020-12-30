<?php

namespace App\Http\Controllers\Api;

use App\Models\Website\BusinessSettings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    private $setting;

    public function __construct()
    {
        $this->setting = BusinessSettings::all();
    }

    public function index(Request $request)
    {
        $general_paginate_count = $this->setting->where('type', 'general_paginate_count')->first();
        $general_paginate_count = $general_paginate_count ? $general_paginate_count->value : 9;

        $records = auth()->user()->addresses()->with('country', 'city', 'user')->latest()->paginate($general_paginate_count);

        if ($records->count() > 0) {
            return response()->json(['status' => 200, 'data' => $records], 200);
        }
        return response()->json(['status' => 400, 'message' => __('messages.no_data')], 200);
    }

    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:addresses,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $record = auth()->user()->addresses()->with('country', 'city', 'user')->find($request->id);

        if ($record) {
            return response()->json(['status' => 200, 'data' => $record], 200);
        }

        return response()->json(['status' => 400, 'message' => __('messages.no_data')], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
            'phone' => 'required',
            'address_details' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $record = auth()->user()->addresses()->create($request->all());
        if ($record) {
            return response()->json(['status' => 200, 'message' => __('messages.success_address')], 200);
        }
        return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:addresses,id',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 500, 'error' => __('messages.validate_error'), 'message' => $validator->messages()], 200);
        }

        $record = auth()->user()->addresses()->find($request->id);
        if ($record) {
            $delete = $record->delete();
            if ($delete) {
                return response()->json(['status' => 200, 'message' => __('messages.address_deleted')], 200);
            }
        }
        return response()->json(['status' => 400, 'message' => __('messages.wrong')], 200);
    }
}

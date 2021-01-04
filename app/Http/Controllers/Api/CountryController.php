<?php

namespace App\Http\Controllers\Api;

use App\Models\Website\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CountryController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => getRequiredStatus('ar') . '|max:191|string|unique:countries',
            'name_en' => getRequiredStatus('en') . '|max:191|string|unique:countries',
            'icon' => 'required',
        ]);
        if ($validator->fails()) {
            return JsonResponse(500, $validator->errors()->messages());
        }
        if ($request->has('icon') && $request->icon) {
            $path = 'uploads/Country';
            $fileName = UploadImage($request->icon, $path);
            $request->merge(['icon' => $fileName]);
        }
        $record = Country::updateOrCreate($request->except('_method', '_token'));

        return JsonResponse(200, getMessage('Country', 'create', 'success'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name_ar' => 'max:191|string',
            'name_en' => 'max:191|string',
        ]);

        if ($validator->fails()) {
            return JsonResponse(500, $validator->errors()->messages());
        }

        $record = Country::find($id);
        $result = $record->update($request->except('_method', '_token', 'icon'));
        if ($request->has('icon') && $request->icon) {
            $path = 'uploads/Country';
            $fileName = UploadImage($request->icon, $path);
            $request->merge(['icon' => $fileName]);
            $record->update([
                'icon' => $fileName
            ]);
        }
        return JsonResponse(200, getMessage('Country', 'update', 'success'));
    }

}

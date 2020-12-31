<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Website\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends BaseController
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
            'name_ar' => getRequiredStatus('ar') . '|max:191|string',
            'name_en' => getRequiredStatus('en') . '|max:191|string',
            'logo' => 'required|mimes:' . getMimesSupport(),
            'meta_title' => 'nullable|max:191|string',
            'meta_description' => 'nullable|text',
        ]);
        if ($validator->fails()) {
            return JsonResponse(500, $validator->errors()->messages());
        }


        if ($request->hasFile('logo')) {
            $path = '/uploads/Brand';
            $fileName = UploadImage($request->file('logo'), $path);
        }
        if (!$request->meta_title && !$request->meta_description) {
            if (getRequiredStatus('ar') && !getRequiredStatus('en')) {
                $meta = generateMetaTages($request->name_ar);
            } else {
                $meta = generateMetaTages($request->name_en);
            }
        }
        $request->merge(['logo' => $fileName, 'meta_title' => $meta['meta_title'], 'meta_description' => $meta['meta_description']]);
        $record = Brand::updateOrCreate($request->except('_method', '_token'));
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
            'logo' => 'mimes:'. getMimesSupport(),
            'meta_title' => 'nullable|max:191|string',
            'meta_description' => 'nullable|text',
        ]);

        if ($validator->fails()) {
            return JsonResponse(500, $validator->errors()->messages());
        }


        if ($request->hasFile('logo')) {
            $path = '/uploads/Brand';
            $fileName = UploadImage($request->file('logo'), $path);
            $request->merge(['logo' => $fileName]);
        }
        $record = Brand::find($id);
        return JsonResponse(500,$request->input('name_ar'));

        $record = $record->update($request->except('_method', '_token'));
        return JsonResponse(200,getMessage('Brand', 'update', 'success'));
    }
}

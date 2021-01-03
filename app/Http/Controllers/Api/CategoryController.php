<?php

namespace App\Http\Controllers\Api;

use App\Models\Website\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
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
            'image' => 'required',
            'meta_title' => 'nullable|max:191|string',
            'meta_description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return JsonResponse(500, $validator->errors()->messages());
        }

        if ($request->has('image') && $request->image) {
            $path = 'uploads/Category';
            $fileName = UploadImage($request->image, $path);
            $request->merge(['image' => $fileName]);
        }
        if (!$request->meta_title && !$request->meta_description) {
            if (getRequiredStatus('ar') && !getRequiredStatus('en')) {
                $meta = generateMetaTages($request->name_ar);
            } else {
                $meta = generateMetaTages($request->name_en);
            }
            $request->merge(['meta_title' => $meta['meta_title'], 'meta_description' => $meta['meta_description']]);
        }
        $request->slug = generateSlug($request->name_en);
        $record = Category::updateOrCreate($request->except('_method', '_token'));

        return JsonResponse(200, getMessage('Category', 'create', 'success'));
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
            'meta_title' => 'nullable|max:191|string',
            'meta_description' => 'nullable',
        ]);

        if ($validator->fails()) {
            return JsonResponse(500, $validator->errors()->messages());
        }

        $record = Category::find($id);
        $result = $record->update($request->except('_method', '_token', 'image'));
        if ($request->has('image') && $request->image) {
            $path = 'uploads/Category';
            $fileName = UploadImage($request->image, $path);
            $request->merge(['image' => $fileName]);
            $record->update([
                'image' => $fileName
            ]);
        }
        return JsonResponse(200, getMessage('Category', 'update', 'success'));
    }
}

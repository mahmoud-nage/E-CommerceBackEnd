<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Website\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogController extends BaseController
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
            'desc_en' => getRequiredStatus('ar'),
            'desc_en' => getRequiredStatus('en'),
//            'user_id' => 'required|exists:users,userable_id',
//            'blog_departments_id' => 'required|exists:blog_departments,id',
            'image' => 'required',
            'meta_title' => 'nullable|max:191|string',
            'meta_description' => 'nullable',
        ]);
        if ($validator->fails()) {
            return JsonResponse(500, $validator->errors()->messages());
        }

        if ($request->has('image') && $request->image) {
            $path = 'uploads/Blog';
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

        $record = Blog::updateOrCreate($request->except('_method', '_token'));
        return JsonResponse(200, getMessage('Blog', 'create', 'success'));
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

        $record = Blog::find($id);
        $result = $record->update($request->except('_method', '_token', 'image'));
        if ($request->has('image') && $request->image) {
            $path = 'uploads/Blog';
            $fileName = UploadImage($request->image, $path);
            $request->merge(['image' => $fileName]);
            $record->update([
                'image' => $fileName
            ]);
        }
        return JsonResponse(200, getMessage('Blog', 'update', 'success'));
    }
}

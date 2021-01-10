<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Website\BlogDepartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogDepartmentController extends BaseController
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
        ]);
        if ($validator->fails()) {
            return JsonResponse(500, $validator->errors()->messages());
        }

        $record = BlogDepartment::updateOrCreate($request->except('_method', '_token'));
        return JsonResponse(200, getMessage('BlogDepartment', 'create', 'success'));
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

        $record = BlogDepartment::find($id);
        $result = $record->update($request->except('_method', '_token'));

        return JsonResponse(200, getMessage('BlogDepartment', 'update', 'success'));
    }
}

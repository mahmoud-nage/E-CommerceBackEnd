<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\BaseController;
use App\Models\Users\Seller;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class SellerController extends BaseController
{


    public function index(Request $request)
    {
        $data = Seller::withCount('orderDetails', 'products', 'payments')->with(['user', 'orderDetails' => function ($q) {
            $q->latest()->first();
        }, 'products' => function ($q) {
            $q->latest()->first();
        }]);

        if ($request->to == null && $request->to <= 0) {
            $request->to = generalPagination();
        }

        if ($request->to == -1) {
            return JsonResponse(200, '', $data->get()->toArray());
        }
        return JsonResponse(200, '', $data->paginate($request->to)->toArray());
    }


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
            'country_id' => 'required|exists:countries,id',
            'city_id' => 'required|exists:cities,id',
        ]);
        if ($validator->fails()) {
            return JsonResponse(500, $validator->errors()->messages());
        }
        $record = Area::updateOrCreate($request->except('_method', '_token'));

        return JsonResponse(200, getMessage('Area', 'create', 'success'));
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
            'country_id' => 'exists:countries,id',
            'city_id' => 'exists:cities,id',
        ]);

        if ($validator->fails()) {
            return JsonResponse(500, $validator->errors()->messages());
        }

        $record = Area::find($id);
        $result = $record->update($request->except('_method', '_token'));
        return JsonResponse(200, getMessage('Area', 'update', 'success'));
    }
}

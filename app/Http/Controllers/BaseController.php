<?php

namespace App\Http\Controllers;

use App\Models\Website\Brand;
use App\Models\Website\BusinessSettings;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    protected $setting;

    public function __construct()
    {
        $this->setting = BusinessSettings::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allData($model, $conditions = [], $sortBy = 'created_at', $sort = 'desc', $with = null, $withCount = null, $to = null)
    {
        if ($model) {
            if (!$sortBy) {
                $sortBy = 'created_at';
            }
            if (!$sort) {
                $sort = 'desc';
            }
            if (count($conditions) > 0) {
                $data = $model::where($conditions)->orderBy($sortBy, $sort);
            } else {
                $data = $model::orderBy($sortBy, $sort);
            }

            if ($data) {
                if ($withCount && !$with) {
                    $data->withCount($withCount);
                } elseif ($with && !$withCount) {
                    $data->with($with);
                } elseif ($with && $withCount) {
                    $data->with($with)->withCount($withCount);
                }
            }
            if($to == -1){
                return JsonResponse(200, '', $data->get()->toArray());
            }
            if ($to == null && $to <= 0) {
                $to = generalPagination();
            }

            return JsonResponse(200, '', $data->paginate($to)->toArray());
        }
    }

    public function getRecord($model, $id, $with = null, $withCount = null)
    {
        if ($model) {
            if ($withCount && !$with) {
                $data = $model::withCount($withCount)->findOrFail($id);
            } elseif ($with && !$withCount) {
                $data = $model::with($with)->findOrFail($id);
            } elseif ($with && $withCount) {
                $data = $model::with($with)->withCount($withCount)->findOrFail($id);
            } else {
                $data = $model::findOrFail($id);
            }
            return JsonResponse(200, '', $data);
        }
    }

    public function changeStatus($model, $id,$request)
    {
        if ($model) {
            if ($request->has('type') && $request->type) {
                $update = $model::findOrFail($id)->update([
                    $request->type => $request->value
                ]);
                if ($update) {
                    return JsonResponse(200, getMessage($model, 'changeStatus', 'success'));
                }
            }
            return JsonResponse(200, getMessage($model, 'changeStatus', 'fail'));
        }
    }

    public function search($model, $query, $with = null, $withCount = null)
    {
        if ($model) {
            if ($withCount && !$with) {
                $data = $model::withCount($withCount)->where('');
            } elseif ($with && !$withCount) {
                $data = $model::with($with)->findOrFail($id);
            } elseif ($with && $withCount) {
                $data = $model::with($with)->withCount($withCount)->findOrFail($id);
            } else {
                $data = $model::findOrFail($id);
            }
            return JsonResponse(200, '', $data);
        }
    }

    public function destroyRecord($model, $id, $image = null)
    {
        if ($model) {
            $data = $model::findOrFail($id);
            if ($image) {
                $imageDel = deleteImage($data->$image);
            }
            if ($data->delete()) {
                return JsonResponse(200, getMessage($model, 'destroy', 'success'));
            } else {
                return JsonResponse(200, getMessage($model, 'destroy', 'fail'));
            }
        }
    }

}

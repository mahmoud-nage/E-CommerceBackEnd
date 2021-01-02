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
    public function allData($model, $conditions = [], $sortBy = 'created_at', $sort = 'desc', $withCount = null, $with=null,$to=null)
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

            if($data){
                if ($withCount && !$with) {
                    $data->withCount($withCount);
                } elseif ($with && !$withCount) {
                    $data->with($with);
                } elseif ($with && $withCount) {
                    $data->with($with)->withCount($withCount);
                }
            }
            if($to == null){
                $to = generalPagination();
            }
            return JsonResponse(200,'',$data->paginate($to)->toArray());
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
            return JsonResponse(200,'',$data);
        }
    }

    public function search($model, $id, $with = null, $withCount = null)
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
            return JsonResponse(200,'',$data);
        }
    }

    public function destroyRecord($model, $id, $image=null)
    {
        if ($model) {
            $data = $model::findOrFail($id);
            if($image){
                $imageDel = deleteImage($data->$image);
            }
            if($data->delete()){
                return JsonResponse(200,getMessage($model, 'destroy', 'success'));
            }else{
                return JsonResponse(200,getMessage($model, 'destroy', 'fail'));
            }
        }
    }

}

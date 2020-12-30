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
    public function allData($model, $conditions = [], $sortBy = 'created_at', $sort = 'desc', $eagerLoading = null)
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
            if ($eagerLoading) {
                $data->$eagerLoading[0];
            }
            return $data;
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
            return $data;
        }
    }

    public function destroyRecord($model, $id, $image)
    {
        if ($model) {
            $data = $model::findOrFail($id);
            $data->delete();
            return $data;
        }
    }

}
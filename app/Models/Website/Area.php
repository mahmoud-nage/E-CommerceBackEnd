<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model
{
    protected $table = 'areas';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'city_id', 'country_id', 'active', 'lat', 'lon');

    public function country()
    {
        return $this->belongsTo('App\Models\Website\Country', 'country_id');
    }
    public function city()
    {
        return $this->belongsTo('App\Models\Website\City', 'city_id');
    }
    public function zones()
    {
        return $this->hasMany('App\Models\Website\Zone');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

}

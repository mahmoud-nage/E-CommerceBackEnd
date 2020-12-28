<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Country extends Model
{
    protected $table = 'countries';
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'currency_id', 'icon', 'active', 'default', 'locales', 'lat', 'lng');
    // protected $visible = array('name_ar', 'name_en', 'currency_id', 'icon', 'active', 'default');

    public function cities()
    {
        return $this->hasMany('App\Models\Website\City');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Website\Currency', 'currency_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

}

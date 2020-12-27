<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    protected $table = 'cities';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'country_id','delivery_price', 'delivery_free', 'lat', 'lng', 'active' );
    // protected $visible = array('name_ar', 'name_en', 'country_id', 'active');

    public function country()
    {
        return $this->belongsTo('App\Models\Website\Country', 'country_id');
    }

    public function areas()
    {
        return $this->hasMany('App\Models\Website\Area');
    }

}

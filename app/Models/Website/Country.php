<?php

namespace App\Models\Website;

use App\Models\Actions;
use App\Models\Main\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Country extends Model
{
    protected $table = 'countries';
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'currency_id', 'icon', 'active', 'default', 'locales', 'lat', 'lon'
    ,'accept_card','accept_kiosk','accept_valu','cash','code','dial_num', 'size_phone','exchange_rate_usd'
    );
    // protected $visible = array('name_ar', 'name_en', 'currency_id', 'icon', 'active', 'default');

    public function cities()
    {
        return $this->hasMany('App\Models\Website\City');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'countries_products');
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

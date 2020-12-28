<?php

namespace App\Models\Main;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Choice extends Model
{
    protected $table = 'choices';
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $fillable = ['name_ar', 'name_en', 'product_id', 'country_product_id'];

    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function countryProducts()
    {
        return $this->belongsTo(CountriesProducts::class , 'country_product_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }


    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

<?php

namespace App\Models\Website;

use App\Models\Actions;
use App\Models\Main\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    protected $table = 'brands';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'logo',
        'in_home', 'active', 'slug', 'meta_title','meta_description'
        );

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

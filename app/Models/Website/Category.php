<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Category extends Model
{
    protected $table = 'categories';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'slug', 'active', 'in_home', 'parent_id', 'type', 'image', 'vendor_commission', 'meta_title', 'meta_description');
    // protected $visible = array('name_ar', 'name_en', 'slug', 'active', 'in_home', 'parent_id', 'type');

    public function subcategories()
    {
        return $this->hasMany('App\Models\Website\Category','parent_id', 'id')->where('parent_id', $this->id);
    }

    public function subSubcategories()
    {
        return $this->hasMany('App\Models\Website\Category','parent_id', 'id')->where('parent_id', $this->id);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Website\Category','parent_id', 'id')->where('type', 0);
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\Website\Category','parent_id', 'id' )->where('type', 1);
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

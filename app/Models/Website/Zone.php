<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Nova\Actions\Actionable;
use Laravel\Nova\Fields\Searchable;

class Zone extends Model 
{
    use searchable , actionable;

    protected $table = 'zones';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'area_id');
    // protected $visible = array('name_ar', 'name_en', 'area_id');

    public function area()
    {
        return $this->belongsTo('App\General\Area', 'area_id');
    }

}
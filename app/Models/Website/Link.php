<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    protected $table = 'links';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'url');

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

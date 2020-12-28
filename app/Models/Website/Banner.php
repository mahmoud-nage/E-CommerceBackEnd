<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    protected $table = 'banners';

    use SoftDeletes;
    protected $dates = ['deleted_at', 'from', 'to'];
    protected $fillable = array('image', 'url', 'position', 'page_type', 'visit_count', 'from', 'to', 'active', 'type', 'show_type');

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

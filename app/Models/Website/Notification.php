<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    protected $table = 'notifications';
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('user_id', 'title_ar', 'title_en', 'body_ar', 'body_en', 'type', 'show_type', 'seen', 'country_id');

    // protected $visible = array('user_id', 'title_ar', 'title_en', 'body_ar', 'body_en', 'type');
    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'user_notifications');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

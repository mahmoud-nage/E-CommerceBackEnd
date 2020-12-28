<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contact extends Model
{
    protected $table = 'contacts';

    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = array('user_id', 'subject', 'message', 'view', 'country_id');
    // protected $visible = array('user_id', 'subject', 'message', 'view');

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

}

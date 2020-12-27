<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{

    protected $table = 'statuses';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en');
    // protected $visible = array('name_ar', 'name_en', 'priority', 'type');

}

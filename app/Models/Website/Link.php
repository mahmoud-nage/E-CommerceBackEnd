<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Link extends Model
{
    protected $table = 'links';
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'url');
}

<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Search extends Model
{
    protected $table = 'searches';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('query', 'count', 'country_id');
    // protected $visible = array('query', 'count');

}

<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    protected $table = 'subscribers';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('email');
}

<?php

namespace App\Models\Website;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    protected $table = 'customers';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('user_id');
//
//    public function user()
//    {
//        return $this->morphOne('App\User', 'userable');
//    }
    public function user(){
        return $this->belongsTo(user::class);
    }
}

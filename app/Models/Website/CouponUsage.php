<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouponUsage extends Model
{
    protected $table = 'coupon_usages';
    protected $fillable = array('user_id', 'coupon_id', 'coupon_affliate_id');
}

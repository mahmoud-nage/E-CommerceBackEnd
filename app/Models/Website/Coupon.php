<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    protected $table = 'coupons';

    use SoftDeletes;

    protected $dates = ['deleted_at', 'start_date', 'end_date'];
    protected $fillable = array('type', 'code', 'details', 'discount', 'discount_type', 'start_date', 'end_date', 'active', 'in_cart', 'show_type', 'visit_count');

}

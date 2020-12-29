<?php

namespace App\Models\Main;

use App\Models\Actions;
use App\Models\User;
use App\Models\Website\Address;
use App\Models\Website\Coupon;
use App\Models\Website\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReturnStock extends Model
{
    protected $table = 'orders';
    use SoftDeletes;
    protected $dates = ['deleted_at','invoicedate','invoiceduedate'];

    protected $fillable = [
        'user_id', 'staff_id', 'guest_id', 'transaction_id', 'status_id', 'affiliate_id', 'coupon_id','address_id','coupon_type','coupon_name',
        'code', 'barcode', 'payment_status', 'pmethod', 'payment_details', 'shipping_address', 'shipment_details',
        'grand_total', 'sub_total', 'shipping', 'discount', 'tax', 'items', 'note', 'extra_discount', 'discount_format', 'currency',
        'coupon_discount', 'viewed', 'device','type','invoicedate','invoiceduedate','awb'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function affilate()
    {
        return $this->belongsTo(User::class, 'affiliate_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'transaction_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class)->with('product');
    }

    public function addresses()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

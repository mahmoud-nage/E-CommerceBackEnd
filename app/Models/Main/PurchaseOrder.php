<?php

namespace App\Models\Main;

use App\Models\Actions;
use App\Models\User;
use App\Models\Website\Address;
use App\Models\Website\Coupon;
use App\Models\Website\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseOrder extends Model
{
    protected $table = 'orders';
    use SoftDeletes;
    protected $dates = ['deleted_at','invoicedate','invoiceduedate'];

    protected $fillable = [
        'staff_id', 'supplier_id', 'transaction_id', 'status', 'code', 'barcode', 'pmethod','payment_details','shipping_address','shipment_details',
        'sub_total', 'grand_total', 'shipping', 'discount', 'tax', 'items', 'note',
        'extra_discount', 'discount_format', 'currency', 'coupon_discount','invoicedate','invoiceduedate'
    ];


    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function supplier()
    {
        return $this->belongsTo(User::class, 'supplier_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class,'transaction_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }}

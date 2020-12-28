<?php

namespace App\Models\Website;

use App\Models\Actions;
use App\Models\Main\PaymentMethod;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'payment_method_id', 'paymentable_id', 'paymentable_type',
        'payment_details', 'status', 'image', 'order_ids', 'provider', 'amount', 'type'
    ];

    public function paymentable()
    {
        return $this->morphTo();
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

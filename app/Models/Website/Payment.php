<?php

namespace App;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['payment_method_id',
        'paymentable_id', 'paymentable_type',
        'payment_details', 'status', 'image',
        'order_ids', 'provider', 'amount'
    ];

    public function paymentable()
    {
        return $this->morphTo();
    }
}

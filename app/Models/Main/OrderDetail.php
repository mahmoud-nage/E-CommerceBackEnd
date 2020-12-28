<?php

namespace App\Models\Main;

use App\Models\Actions;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['payment_status'];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class , 'seller_id');
    }

    public function Variation()
    {
        return $this->belongsTo(Variation::class , 'variation_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

}

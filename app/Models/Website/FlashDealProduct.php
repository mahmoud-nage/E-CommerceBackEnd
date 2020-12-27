<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;

class FlashDealProduct extends Model
{
    protected $table = 'flash_deal_products';

    protected $fillable = array('flash_deal_id', 'product_id', 'country_id', 'amount',
        'discount', 'discount_type');

}

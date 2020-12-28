<?php

namespace App\Models\Website;

use App\Models\Actions;
use App\Models\Main\Product;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable = ['user_id', 'product_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

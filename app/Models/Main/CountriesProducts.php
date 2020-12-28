<?php

namespace App\Models\Main;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountriesProducts extends Model
{
    protected $table = 'countries_products';
    use SoftDeletes, HasFactory;
    protected $dates = ['deleted_at'];
    protected $fillable = array('product_id', 'country_id', 'unit_price', 'purchase_price', 'alert', 'current_stock', 'choice_options',
        'colors', 'variations', 'warehouse_id',
        'shipping_type', 'shipping_cost', 'num_of_sale',
        'discount', 'discount_type', 'tax',
        'tax_type', 'contest', 'location',
        'page'
    );

    public function Variations()
    {
        return $this->hasMany(Variation::class, 'country_product_id', 'id');
    }

    public function choices()
    {
        return $this->hasMany(Choice::class, 'country_product_id', 'id')->with('options');
    }


    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

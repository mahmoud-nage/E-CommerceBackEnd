<?php

namespace App\Models\Main;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variation extends Model
{
    protected $table = 'variations';
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['choices_values', 'sku', 'qty', 'price', 'product_id', 'country_product_id', 'image', 'active'];

    protected $casts = ['choices_values' => 'array'];

    public function getChoice()
    {
        $data = '';
        // dd(json_decode($this->choices_values));
        foreach (json_decode($this->choices_values) as $key => $choices_value) {
            $option = Option::find($choices_value);
            $val = $option->is_color == 1 ? $option->Color->name : $option['value_' . app()->getLocale()];
            $title = $option->Choice['name_' . app()->getLocale()];
            $data .= $key > 0 ? ' ,' . $title . ' : ' . $val : $title . ' : ' . $val;
        }
        return $data;
    }

    public function countryProducts()
    {
        return $this->belongsTo(CountriesProducts::class, 'country_product_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

}

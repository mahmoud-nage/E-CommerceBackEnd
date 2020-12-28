<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FlashDeal extends Model
{
    protected $table = 'flash_deals';
    use SoftDeletes;

    protected $dates = ['deleted_at', 'start_date', 'end_date'];
    protected $fillable = array('name_ar', 'name_en', 'label_ar', 'label_en',
        'stockMsg_ar', 'stockMsg_en', 'start_date', 'end_date', 'country_id',
        'show_type', 'visit_count', 'active');

    public function products()
    {
        return $this->belongsToMany(Product::class, 'flash_deal_products');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

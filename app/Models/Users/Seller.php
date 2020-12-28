<?php

namespace App\Models\Users;

use App\Models\Actions;
use App\Models\Main\Product;
use App\Models\User;
use App\Models\Website\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seller extends Model
{

    protected $table = 'sellers';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('vodafone_status', 'vodafone_number', 'postal_status',
        'postal_national_id', 'postal_client_name', 'bank_account_status', 'bank_name', 'bank_account_username', 'bank_account_number',
        'bank_branch', 'docid', 'SSN', 'balance', 'all_sales', 'countProducts', 'countCategory', 'countBrand', 'countPendingOrders',
        'countDeliveredOrders', 'rating', 'countRateRequest', 'name_ar', 'name_en', 'logo', 'sliders', 'address_ar', 'address_en',
        'desc_ar', 'desc_en', 'facebook', 'google', 'twitter', 'youtube', 'slug', 'meta_title', 'meta_description', 'type',
        'is_blocked', 'active');

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function products()
    {
        return $this->hasManyThrough(Product::class, User::class);
    }

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

//    public function reviews()
//    {
//        return $this->hasMany('App\General\Review', 'company_id', 'id')->with('user');
//    }
}

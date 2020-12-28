<?php

namespace App\Models\Main;

use App\Models\Actions;
use App\Models\User;
use App\Models\Website\Brand;
use App\Models\Website\Category;
use App\Models\Website\Country;
use App\Models\Website\Review;
use App\Models\Website\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $table = 'products';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'desc_ar', 'desc_en', 'label_ar', 'label_en', 'slug',
        'user_id', 'added_by', 'category_id',
        'subCategory_id', 'subSubCategory_id', 'brand_id',
        'photos', 'thumbnail_img', 'featured_img',
        'flash_deal_img', 'tags', 'active',
        'in_home', 'is_affiliate', 'is_package',
        'code', 'code_type', 'barcode',
        'unit', 'num_of_sale', 'rating',
        'meta_title', 'meta_description', 'meta_img'
    );


    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo(Category::class, 'subCategory_id');
    }

    public function subSubCategory()
    {
        return $this->belongsTo(Category::class, 'subSubCategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function countries()
    {
        return $this->belongsToMany(Country::class, 'countries_products');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->where('status', 1)->with('user');
    }

    public function choices()
    {
        return $this->hasMany(Choice::class)->with('options');
    }

    public function Variations()
    {
        return $this->hasMany(Variation::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }



//    public function get_price($country_id)
//    {
//        $product = DB::table('product_countries')->where('product_id', $this->id)->where('country_id', $country_id)->first();
//        if (isset($product)) {
//            return $product->unit_price;
//        } else {
//            return 0.0;
//        }
//    }
//
//    public function api_get_price($product_id, $country_id)
//    {
//        $product = Product::find($product_id);
//        $product_country = \Illuminate\Support\Facades\DB::table('product_countries')->where('product_id', $product->id)->where('country_id', $country_id)->first();
//        $quantity = 0;
//        $discount = 0;
//        $tax = 0;
//
//        //discount calculation
//        $flash_deal = \App\FlashDeal::where('status', 1)->first();
//        if ($flash_deal != null && strtotime(date('d-m-Y')) >= $flash_deal->start_date && strtotime(date('d-m-Y')) <= $flash_deal->end_date && \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first() != null) {
//            $flash_deal_product = \App\FlashDealProduct::where('flash_deal_id', $flash_deal->id)->where('product_id', $product->id)->first();
//        }
//
//        $price = $product_country->unit_price;
//        $discount = null;
//        $discount_type = null;
//        if(isset($flash_deal_product)){
//            if ($flash_deal_product->discount_type == 'percent') {
//                $price -= ($price * $flash_deal_product->discount) / 100;
//            } elseif ($flash_deal_product->discount_type == 'amount') {
//                $price -= $flash_deal_product->discount;
//            }
//            $discount = $flash_deal_product->discount;
//            $discount_type = $flash_deal_product->discount_type;
//        } else {
//            if ($product_country->discount_type == 'percent') {
//                $price -= ($price * $product_country->discount) / 100;
//            } elseif ($product_country->discount_type == 'amount') {
//                $price -= $product_country->discount;
//            }
//            $discount = $product_country->discount;
//            $discount_type = $product_country->discount_type;
//        }
//
//        if ($product_country->tax_type == 'percent') {
//            $price += ($price * $product_country->tax) / 100;
//        } elseif ($product_country->tax_type == 'amount') {
//            $price += $product_country->tax;
//        }
//        $unit_price = $price;
//        if( $product_country->unit_price == $unit_price){
//            return array('unit_price' => null, 'discount' => null, 'discount_type' => null);
//        }else{
//            return array('unit_price' => $unit_price, 'discount' => $discount, 'discount_type' => $discount_type);
//        }
//    }
//
//    public function get_discount($country_id)
//    {
//
//        $prod = DB::table('product_countries')->where('product_id', $this->id)->where('country_id', $country_id)->first();
//
//        if(isset($prod) && $prod->discount>0){
//            $sym= $prod->discount_type=='amount'?single_price($prod->discount):$prod->discount.'%';
//            return __('general.discount').' '. $sym;
//        }
//        return 0;
//    }
//
//    public function get_tax($country_id)
//    {
//        $prod = DB::table('product_countries')->where('product_id', $this->id)->where('country_id', $country_id)->first();
//        return $prod->tax . ' ' . $prod->tax_type;
//    }

//


}

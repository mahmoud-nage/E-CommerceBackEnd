<?php

namespace App\Models\Website;

use App\Models\Actions;
use App\Models\Main\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    protected $table = 'reviews';
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('user_id', 'product_id', 'comment', 'active', 'in_home', 'rate', 'likes_count', 'dislikens_count', 'country_id');

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'comment_likes', 'user_id');
    }
//
//    public function seller()
//    {
//        return $this->belongsTo('App\Models\Website\Product', 'product_id');
//    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

}

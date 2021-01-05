<?php

namespace App\Models\Users;

use App\Models\Actions;
use App\Models\Main\Order;
use App\Models\User;
use App\Models\Website\Address;
use App\Models\Website\Review;
use App\Models\Website\Ticket;
use App\Models\Website\Wishlist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    protected $table = 'customers';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function orders()
    {
        return $this->hasManyThrough(Order::class, User::class, 'userable_id', 'user_id');
    }
    public function reviews()
    {
        return $this->hasManyThrough(Review::class, User::class, 'userable_id', 'user_id');
    }
    public function wishlists()
    {
        return $this->hasManyThrough(Wishlist::class, User::class, 'userable_id', 'user_id');
    }
    public function tickets()
    {
        return $this->hasManyThrough(Ticket::class, User::class, 'userable_id', 'user_id');
    }
    public function address()
    {
        return $this->hasManyThrough(Address::class, User::class, 'userable_id', 'user_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

}

<?php

namespace App\Models;

use App\Models\Website\Address;
use App\Models\Website\Area;
use App\Models\Website\City;
use App\Models\Website\Contact;
use App\Models\Website\Country;
use App\Models\Website\Notification;
use App\Models\Website\Payment;
use App\Models\Website\Review;
use App\Models\Website\Ticket;
use App\Models\Website\Zone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',

        'provider',
        'provider_id',
        'remember_token',
        'api_token',
        'fcm_token',

        'avatar',
        'gender',
        'address',
        'dob',

        'country_id',
        'city_id',
        'area_id',
        'zone_id',

        'reset_code',
        'postal_code',

        'phone',
        'balance',
        'device',
        'code',
        'default_lang',
        'signature',

        'active',
        'blocked',
        'blocked_reason',

        'lat',
        'lon',

        'userable_id',
        'userable_type',
        'user_type',

        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'fcm_token',
        'api_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'deleted_at' => 'date',
        'birth_date' => 'date'
    ];

//    public function isSuperAdmin()
//    {
//        return $this->hasRole('super-admin');
//    }

    public function userable()
    {
        return $this->morphTo();
    }

    public function notifications()
    {
        return $this->belongsToMany(Notification::class, 'notification_id');
    }

    public function adminNotifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
//
//    public function wishlists()
//    {
//        return $this->belongsToMany('App\Models\Seller::,'wishlists');
//    }
//
//    public function reviewLikes()
//    {
//        return $this->belongsToMany('App\Models\Review', 'comment_likes', 'review_id');
//    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class ,'city_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class, 'zone_id');
    }
}

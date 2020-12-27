<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
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
        return $this->belongsToMany('App\Models\Notification', 'notification_id');
    }

    public function adminNotifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review', 'user_id', 'id')->with('company');
    }

    public function wishlists()
    {
        return $this->belongsToMany('App\Models\Seller','wishlists');
    }

    public function reviewLikes()
    {
        return $this->belongsToMany('App\Models\Review', 'comment_likes', 'review_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\Country', 'country_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City' ,'city_id');
    }

    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'area_id');
    }

    public function zone()
    {
        return $this->belongsTo('App\Models\Zone', 'zone_id');
    }
}

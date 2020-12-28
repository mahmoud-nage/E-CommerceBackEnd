<?php

namespace App\Models\Website;

use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'country_id','city_id' ,'area_id', 'zone_id',
        'building_no', 'floor_no' , 'apartment_no' , 'address_details' , 'special_mark', 'phone', 'phone1'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class , 'country_id');
    }

    public function area()
    {
        return $this->belongsTo(Area::class , 'area_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class , 'city_id');
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class , 'zone_id');
    }
}

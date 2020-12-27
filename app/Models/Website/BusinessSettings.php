<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;

class BusinessSettings extends Model
{

    protected $table = 'business_settings';
    protected $fillable = array('type', 'value', 'country_id');
    // protected $visible = array('type', 'value');

}

<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{

    protected $table = 'general_settings';

    protected $dates = ['deleted_at'];
    protected $fillable = array('frontend_color', 'logo', 'admin_logo', 'admin_login_background', 'admin_login_sidebar', 'favicon', 'address_ar', 'address_en', 'site_ar', 'site_en', 'lat', 'lon',
    'phone', 'email' ,'facebook','instagram','twitter','youtube','google_plus','google_play_store','apple_store','app_gallary_store',
        'withdrawal_duration','cat_nav_count'
    );
    // protected $visible = array('logo', 'favicon', 'address_ar', 'address_en', 'site_ar', 'site_en', 'lat', 'lon');

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

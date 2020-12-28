<?php

namespace App\Models\Main;

use App\Models\Actions;
use App\Models\Website\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentMethod extends Model
{
    protected $table = 'payment_methods';
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'active', 'type', 'value', 'country_id');
    // protected $visible = array('name_ar', 'name_en', 'active', 'type');

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

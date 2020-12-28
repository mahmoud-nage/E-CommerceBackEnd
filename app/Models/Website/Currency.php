<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $fillable = [ 'name_en' ,'name_ar' , 'symbol' . 'exchange_rate' , 'active' , 'code'];

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

}

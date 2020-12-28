<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;

class Tokens extends Model
{
        protected $fillable = ['fcm_token'];

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

}

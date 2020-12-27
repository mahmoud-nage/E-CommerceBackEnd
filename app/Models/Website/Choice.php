<?php

namespace App\Models\Website;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $fillable = ['name_ar', 'name_en', 'active'];
}

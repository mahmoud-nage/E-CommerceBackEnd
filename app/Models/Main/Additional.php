<?php

namespace App\Models\Main;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Additional extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'accounts';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name_ar', 'name_en', 'value', 'type', 'active'];
}

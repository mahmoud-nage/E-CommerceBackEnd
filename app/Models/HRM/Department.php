<?php

namespace App\Models\HRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'accounts';
    protected $dates = ['deleted_at'];
    protected $fillable = ['name_ar', 'name_en', 'note', 'active'];
}

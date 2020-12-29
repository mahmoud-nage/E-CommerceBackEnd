<?php

namespace App\Models\HRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payroll extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'accounts';
    protected $dates = ['deleted_at'];
    protected $fillable = ['user_id', 'month', 'year', 'amount', 'pmethod'];
}

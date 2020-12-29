<?php

namespace App\Models\Finance;

use App\Models\Main\Option;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Account extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'accounts';
    protected $dates = ['deleted_at'];
    protected $fillable = ['number', 'holder', 'balance', 'code', 'account_type', 'note', 'active'];
}

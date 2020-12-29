<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionCategory extends Model
{
    protected $table = 'transaction_categories';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name_ar', 'name_en', 'note', 'active'
    ];
}

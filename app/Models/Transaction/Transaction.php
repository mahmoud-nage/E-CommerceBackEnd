<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    protected $table = 'transaction_categories';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'account_id', 'bill_id', 'staff_id', 'trans_category_id',
        'customer_id', 'customer_name', 'debit', 'credit',
        'pmethod', 'note', 'status'
    ];
}

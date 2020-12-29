<?php

namespace App\Models\Transaction;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionHistory extends Model
{
    protected $table = 'transaction_histories';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'party_id', 'staff_id','note','active'
    ];

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'party_id');
    }

}

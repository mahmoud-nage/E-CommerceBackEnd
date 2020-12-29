<?php

namespace App\Models\Main;

use App\Models\Actions;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    protected $table = 'suppliers';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['docid', 'SSN' ,'debit','credit', 'countProducts', 'countTransaction', 'countOrders', 'name_ar', 'name_en', 'logo', 'desc_ar', 'desc_en', 'is_blocked', 'active'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

<?php

namespace App\Models\Users;

use App\Models\Actions;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    protected $table = 'customers';

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

}

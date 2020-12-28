<?php

namespace App\Models\Users;

use App\Models\Actions;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Model
{
    protected $table = 'staffs';
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('type', 'role');
    // protected $visible = array('type');

    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

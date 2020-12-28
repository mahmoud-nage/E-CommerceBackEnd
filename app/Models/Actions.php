<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Actions extends Model
{
    protected $table = 'actions';
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('user_id', 'name', 'actionable_type', 'actionable_id', 'original', 'changes');

    public function actionable()
    {
        return $this->morphTo();
    }
}

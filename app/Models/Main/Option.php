<?php

namespace App\Models\Main;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Option extends Model
{

    protected $table = 'options';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    protected $fillable = ['image', 'value' ,'name_ar','name_en', 'choice_id', 'is_color'];

    public function Choice()
    {
        return $this->belongsTo(Choice::class , 'choice_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }

}

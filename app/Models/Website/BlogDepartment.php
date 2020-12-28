<?php

namespace App\Models\Website;

use App\Models\Actions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogDepartment extends Model
{
    protected $table = 'blog_departments';
    use SoftDeletes;
    protected $fillable = ['name_ar', 'name_en', 'active'];

    public function blogs(){
        return $this->hasMany(Blog::class,'blog_department_id','id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

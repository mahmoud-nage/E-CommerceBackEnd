<?php

namespace App\Models\Website;

use App\Models\Actions;
use App\Models\User;
use App\Models\Users\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    protected $table = 'blogs';
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name_ar', 'name_en', 'desc_ar', 'desc_en', 'active', 'in_home', 'read_num', 'country_id',
        'meta_description', 'meta_title', 'image', 'staff_id', 'blog_departments_id');
    // protected $visible = array('name_ar', 'name_en', 'desc_ar', 'desc_en', 'active', 'in_home', 'read_num');

    public function department()
    {
        return $this->belongsTo(BlogDepartment::class, 'blog_departments_id');
    }

    public function user()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }


}

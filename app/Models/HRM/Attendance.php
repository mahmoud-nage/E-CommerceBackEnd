<?php

namespace App\Models\HRM;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendance extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'accounts';
    protected $dates = ['deleted_at', 'present'];
    protected $fillable = ['user_id', 'present', 't_from', 't_to', 'note', 'actual_hours'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

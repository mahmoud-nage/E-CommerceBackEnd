<?php

namespace App\General;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationUser extends Model
{

    protected $table = 'notification_users';

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('user_id', 'notification_id', 'seen', 'provider');
    // protected $visible = array('user_id', 'notification_id', 'seen', 'provider');

}

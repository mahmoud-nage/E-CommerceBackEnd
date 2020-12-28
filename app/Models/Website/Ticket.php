<?php

namespace App\Models\Website;

use App\Models\Actions;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable =['code' , 'user_id' , 'subject' , 'details' , 'files' , 'status' , 'viewed'];


    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function ticketreplies()
    {
        return $this->hasMany(TicketReply::class)->orderBy('created_at', 'desc');
    }
    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }


}

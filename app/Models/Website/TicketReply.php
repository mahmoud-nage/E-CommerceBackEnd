<?php

namespace App\Models\Website;

use App\Models\Actions;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable =['ticket_id' , 'user_id' , 'reply' , 'files'];


    public function ticket(){
    	return $this->belongsTo(Ticket::class);
    }
    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function actions()
    {
        return $this->morphMany(Actions::class, 'actionable');
    }
}

<?php


namespace App\Traits;


use App\Models\TicketMessage;
use App\Models\User;

trait SupportTicketRelations
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticketMessages(){
        return $this->hasMany(TicketMessage::class);
    }
}

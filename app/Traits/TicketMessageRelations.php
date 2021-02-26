<?php


namespace App\Traits;


use App\Models\SupportTicket;
use App\Models\User;

trait TicketMessageRelations
{
    public function user(){
        return  $this->belongsTo(User::class);
    }

    public function supportTicket(){
        return  $this->belongsTo(SupportTicket::class);
    }
}

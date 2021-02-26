<?php


namespace App\Traits;


use App\Models\User;

trait RosterRelations
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}

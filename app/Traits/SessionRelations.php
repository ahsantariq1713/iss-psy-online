<?php


namespace App\Traits;


use App\Models\User;

trait SessionRelations
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}

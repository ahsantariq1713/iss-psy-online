<?php


namespace App\Traits;


use App\Models\User;

trait ExperienceRelations
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}

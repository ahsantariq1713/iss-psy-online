<?php


namespace App\Traits;


use App\Models\User;

trait EducationRelations
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}

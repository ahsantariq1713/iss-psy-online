<?php


namespace App\Traits;


use App\Models\User;

trait ReservedSessionRelations
{
    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }

    public function therapist(){
        return $this->belongsTo(User::class, 'therapist_id');
    }
}

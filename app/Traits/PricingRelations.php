<?php


namespace App\Traits;


use App\Models\User;

trait PricingRelations
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}

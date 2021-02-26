<?php

namespace App\Traits;

use App\Models\User;

trait IdentityRelations
{
    public function user(){
        return $this->belongsTo(User::class);
    }
}

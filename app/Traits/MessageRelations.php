<?php

namespace App\Traits;

use App\Models\Conversation;
use App\Models\User;

trait MessageRelations
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }
}

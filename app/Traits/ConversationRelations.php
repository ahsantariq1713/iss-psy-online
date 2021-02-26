<?php

namespace App\Traits;

use App\Models\Message;
use App\Models\User;

trait ConversationRelations
{
    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }

    public function therapist(){
        return $this->belongsTo(User::class, 'therapist_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }
}

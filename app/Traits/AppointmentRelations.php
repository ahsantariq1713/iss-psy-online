<?php

namespace App\Traits;

use App\Models\AppointmentFile;
use App\Models\Conversation;
use App\Models\User;

trait AppointmentRelations
{
    public function client(){
        return $this->belongsTo(User::class, 'client_id');
    }

    public function therapist(){
        return $this->belongsTo(User::class, 'therapist_id');
    }

    public function files()
    {
        return $this->hasMany(AppointmentFile::class);
    }

    public function conversations(){
        return $this->hasMany(Conversation::class);
    }

}

<?php

namespace App\Traits;

use App\Models\Appointment;
use App\Models\User;

trait AppointmentFileRelations
{
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}

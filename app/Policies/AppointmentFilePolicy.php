<?php

namespace App\Policies;

use App\Models\Appointment;
use App\Models\AppointmentFile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AppointmentFilePolicy
{
    use HandlesAuthorization;

    public function upload(Appointment $appointment, AppointmentFile $file){
        return $appointment->active();
    }

    public function download(User $user, AppointmentFile $appointmentFile)
    {
        dd('called');
        return $appointmentFile->user->id($user) || $user->isAdmin();
    }

    public function delete(User $user, AppointmentFile $appointmentFile)
    {
        return $appointmentFile->user->id($user) && $appointmentFile->appointment->active();
    }
}

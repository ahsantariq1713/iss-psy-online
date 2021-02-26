<?php

namespace App\Models;

use App\Helpers\UserRoles;
use App\Traits\AppointmentRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Appointment extends Model
{
    use HasFactory, AppointmentRelations;

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'therapist_attended_at' => 'datetime',
        'client_attended_at' => 'datetime',
    ];

    public function participant()
    {
        return Auth::user()->role == UserRoles::THERAPIST ? $this->client : $this->therapist;
    }


    public function allowUpdate()
    {
        return $this->status == 'Active';
    }

    public function allowUpdateRecommendations()
    {
        if ($this->status == 'Active') {
            return true;
        } else if ($this->status == 'Completed') {

            return $this->end_date->diffInHours(now()) <= 24;
        }
        return false;
    }

    public function meetingUrl(){
        $accessToken = Auth::user()->isTherapist() ? $this->therapist_access_token : $this->client_access_token;
        return route('attend-meeting', [$this->id, $accessToken]);
    }

    public function isPending()
    {
        return $this->status == 'Pending';
    }

    public function isActive()
    {
        return $this->status == 'Active';
    }

    public function isCompleted()
    {
        return $this->status == 'Completed';
    }

    public function requiresFeedback()
    {
        return $this->stars == null && ($this->status == 'Completed' || $this->status == 'Cancelled');
    }

    public function accessToken()
    {
        $key = strtolower(Auth::user()->role) . '_access_token';
        return $this[$key];
    }

    public function meetingAllowed()
    {
        //    return true;
        return $this->start_date->isPast() &&  not($this->end_date->isPast());
    }
}

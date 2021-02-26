<?php


namespace App\Traits;

use App\Models\Appointment;
use App\Models\AppointmentFile;
use App\Models\Conversation;
use App\Models\Education;
use App\Models\EmergencyPhone;
use App\Models\Experience;
use App\Models\Identity;
use App\Models\Language;
use App\Models\Message;
use App\Models\PracticeLicense;
use App\Models\Pricing;
use App\Models\ProfileLog;
use App\Models\Roster;
use App\Models\Session;
use App\Models\Specialism;
use App\Models\SupportTicket;
use App\Models\TicketMessage;

trait UserRelations
{
    public function specialisms()
    {
        return $this->belongsToMany(Specialism::class , 'specialism_user');
    }

    public function emergencyPhone()
    {
        return $this->hasOne(EmergencyPhone::class);
    }

    public function profileLog()
    {
        return $this->hasOne(ProfileLog::class);
    }

    public function identity()
    {
        return $this->hasOne(Identity::class);
    }

    public function license()
    {
        return $this->hasOne(PracticeLicense::class);
    }

    public function educations(){
        return $this->hasMany(Education::class);
    }

    public function experiences(){
        return $this->hasMany(Experience::class);
    }

    public function roster(){
        return $this->hasOne(Roster::class);
    }

    public function sessions(){
        return $this->hasMany(Session::class);
    }

    public function pricing(){
        return $this->hasOne(Pricing::class);
    }

    public function languages()
    {
        return $this->belongsToMany(Language::class, 'user_language');
    }

    public function clientAppointments()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }
    public function therapistAppointments()
    {
        return $this->hasMany(Appointment::class, 'therapist_id');
    }

    public function files()
    {
        return $this->hasMany(AppointmentFile::class);
    }

    public function conversationsAsClient(){
        return $this->hasMany(Conversation::class, 'client_id');
    }

    public function conversationsAsTherapist(){
        return $this->hasMany(Conversation::class, 'therapist_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function supportTickets(){
        return $this->hasMany(SupportTicket::class);
    }

    public function ticketMEssages(){
        return $this->hasMany(TicketMessage::class);
    }


}

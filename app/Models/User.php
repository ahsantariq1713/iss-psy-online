<?php

namespace App\Models;

use App\Helpers\ProfileLogStatus;
use App\Helpers\UserRoles;
use App\Helpers\VerificationCodes;
use App\Traits\UserRelations;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;


class User extends Authenticatable
{
    use HasFactory, Notifiable, UserRelations;

    protected $guarded = ['id', 'password', 'role', 'remember_token', 'stripe_acc_id', 'password_reset_token', 'prt_valid_till'];

    protected $hidden = ['password', 'remember_token', 'stripe_acc_id', 'password_reset_token'];

    protected $casts = [
        'email_verified_at' => 'datetime', 'phone_verified_at' => 'datetime',
        'active' => 'boolean', 'subscribed_newsletter' => 'boolean'
    ];

    public function setPasswordHash($password)
    {
        $this->password = Hash::make($password);
    }

    public function passPasswordChallenge($password)
    {
        return Hash::check($password, $this->password);
    }

    public function failPasswordChallenge($password)
    {
        return !(Hash::check($password, $this->password));
    }

    public function birthday()
    {
        return $this->birthday == null ? 'NA' : Carbon::parse($this->birthday)->toFormattedDateString();
    }

    public function whenPasswordChanged()
    {
        if ($this->password_changed_at == null) return 'Not Changed';
        return 'Last Changed ' . Carbon::parse($this->password_changed_at)->diffForHumans();
    }

    public function whenEmailVerified(){
       return $this->email_verified_at ? $this->email_verified_at->format('d M, Y') : 'NA';
    }

    public function whenPhoneVerified(){
       return $this->phone_verified_at ? $this->phone_verified_at->format('d M, Y') : 'NA';
    }

    public function getPricingHColAttribute()
    {
        if($this->pricing == null)
        {
            return 0;
        }

        return $this->pricing->fee;
    }

    public function getExperienceYearsHColAttribute()
    {
        return $this->experienceYears();
    }


    public function emailVerificationLink()
    {
        $verification = VerificationCode::where('medium', $this->email)->where('type', VerificationCodes::EMAIL_VERIFICATION)->first();

        if (not_null($this->email)) {
            if (is_null($verification)) {
                $verification = VerificationCode::send('mail', $this->email, VerificationCodes::EMAIL_VERIFICATION);
            }
            return '/verify-email/' . $verification->id;
        } else {
            return '/setup-email';
        }
    }

    public function phoneVerificationLink()
    {
        $verification = VerificationCode::where('medium', $this->phone)->where('type', VerificationCodes::PHONE_VERIFICATION)->first();
        if (not_null($this->phone)) {
            if (is_null($verification)) {
                $verification = VerificationCode::send('nexmo', $this->phone, VerificationCodes::PHONE_VERIFICATION);
            }
            return '/verify-phone/' . $verification->id;
        } else {
            return '/setup-phone';
        }
    }

    public function isTherapist()
    {
        return $this->role == UserRoles::THERAPIST;
    }

    public function isClient()
    {
        return $this->role == UserRoles::CLIENT;
    }

    public function isAdmin()
    {
        return $this->role == UserRoles::ADMIN;
    }

    public function hasRole($role)
    {
        return strtolower($this->role) == strtolower($role);
    }

    public function experienceYears()
    {
        $years = 0;
        foreach ($this->experiences as $experience) {
            $years += $experience->end - $experience->start;
        }
        return $years;
    }

    public function proProfileSubmissionRequired()
    {
        return $this->proProfileRequirementsSatisfied() && ($this->profileLog->status == 'Pending' || $this->profileLog->status == ProfileLogStatus::DISAPPROVED);
    }

    public function proProfileRequirementsSatisfied()
    {
        return
            $this->profileLog->identity &&
            $this->profileLog->license &&
            $this->profileLog->education &&
            $this->profileLog->experience &&
            $this->profileLog->roster &&
            $this->profileLog->sessions &&
            $this->profileLog->pricing &&
            $this->profileLog->payment;
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    public function rating()
    {
        if($this->therapistAppointments == null || $this->therapistAppointments->count() == 0)
        {
            return 0;
        }

        $query =  $this->therapistAppointments->where('stars', '!=', null);
        $count = $query->count();
        $stars = $query->sum('stars');
        if ($stars <= 0) return 0;
        return $stars / $count;
    }

    public function getBookingCalendar($timezone = null)
    {
        if ($timezone == null && Auth::check()) {
            $timezone = Auth::user()->timezone;
        }

        $id = 1;
        //get current date time
        $today = \Carbon\CarbonImmutable::now('utc');
        //create new calendar
        $calendar = [];
        //mark false to supporse that there is no date available to book
        $calendar['available'] = false;
        $nextDayAppointments = [];
        $dates = [];
        //now get seven days from now
        for ($i = 1; $i <= 7; $i++) {
            //get current day
            $weekDay = strtolower($today->format('l'));
            //create a date for calendar
            $date = [];
            $date['id'] = $id++;
            $date['available'] = false;
            $date['date'] = $today->format('d');
            $date['month'] = $today->format('M Y');
            $date['day'] = $today->format('l');
            $appointments = [];

            foreach ($nextDayAppointments as $nextDayAppointment) {
                $appointments[] = $nextDayAppointment;
            };
            $nextDayAppointments = [];
            //user is availavble on this day
            if ($this->roster[$weekDay]) {
                $sessions = $this->sessions->where('day', $weekDay)->where('active', true);
                //active sessions available for today
                foreach ($sessions as $session) {
                    $appointment['id'] = $id++;
                    $appointment['start'] = $today->setTimeFrom($session->start);
                    $appointment['end'] = $today->setTimeFrom($session->end);
                    // dump($appointment['start']->setTimeZone($timezone)->format('d-m-Y h:i'));
                    // dump(Appointment::where('start_date', $appointment['start'])->exists() ||
                    //     $appointment['start']->setTimeZone($timezone) < now()->setTimeZone($timezone));
                    //this session is not booked and not in past
                    if (
                        Appointment::where('start_date', $appointment['start'])->exists() ||
                        $appointment['start']->setTimeZone($timezone) < now()->setTimeZone($timezone)
                    ) {
                        //the current session is in past or already booked so we will not mark true for calndar and date
                        // dump($appointment['start']->setTimeZone($timezone)->format('d-m-Y h:i') . ' is not available');
                    } else {
                        if ($appointment['start']->setTimeZone($timezone)->format('d') != $date['date']) {
                            $nextDayAppointments[] = $appointment;
                        } else {
                            $date['available'] = true;
                            $calendar['available'] = true;
                            $appointments[] = $appointment;
                        }
                    }
                }
            }
            $date['appointments'] = $appointments;
            $dates[] = $date;
            $today = $today->addDays(1);
        }
        $calendar['dates'] = $dates;

        // dd($calendar);
        return $calendar;
    }
}

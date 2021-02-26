<?php

namespace App\Models;

use App\Helpers\PartialHide;
use App\Notifications\SecretCodeVerification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class VerificationCode extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $guarded = [];
    protected $hidden = ['code'];

    public static function send($channel, $medium, $type)
    {
        $code = rand(111111, 999999);
        $secretCode = VerificationCode::create([
            'id' => uniqid(),
            'code' => Hash::make($code),
            'channel' => $channel,
            'medium' => $medium,
            'type' => $type
        ]);
        Notification::route($channel, $medium)->notify(new SecretCodeVerification($code, $type));

        return $secretCode;
    }

    public function resend()
    {
        $code = rand(111111, 999999);
        $this->update(['code' => Hash::make($code), 'attempts' => 0]);
        Notification::route($this->channel, $this->medium)->notify(new SecretCodeVerification($code, $this->type));
    }

    public function passSecretChallenge($code)
    {
        $this->incrementAttemptCount();
        return Hash::check($code, $this->code);
    }

    public function isExpired()
    {
        return $this->isExpiredWithTime() || $this->hasTooManyAttempts();
    }

    public function isExpiredWithTime(){
       return now()->diffInMinutes($this->updated_at) > 60;
    }

    public function incrementAttemptCount(){
        $this->attempts++;
        $this->save();
    }

    public function hasTooManyAttempts(){
       return $this->attempts > 3;
    }

    public function sentMessage()
    {
        return
            'Please enter 6-digit verification code we sent to your ' .
            (
                // $this->channel == 'mail'
                // ? 'email ' . PartialHide::email($this->medium)
                // : 'phone ' . PartialHide::phone($this->medium)
                $this->channel == 'mail'
                ? 'email ' . $this->medium
                : 'phone ' . $this->medium
            );

    }
}

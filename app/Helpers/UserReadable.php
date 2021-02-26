<?php

namespace App\Helpers;

use Carbon\Carbon;
use Carbon\CarbonImmutable;

class UserReadable
{
    public static function time($time,$ownertz,$visitortz){
        return
        Carbon::now($ownertz)
        ->setTimeFromTimeString($time)
        ->setTimezone('UTC')
        ->setTimeZone($visitortz);
    }

    public static function sessionDate($date,$visitortz){
        return CarbonImmutable::parse($date)->setTimeZone($visitortz);
    }
}

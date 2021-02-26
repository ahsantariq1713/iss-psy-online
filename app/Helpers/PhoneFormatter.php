<?php

namespace App\Helpers;

class PhoneFormatter
{
    public static function format($phone)
    {
        return substr($phone, 0, strlen($phone) - 10) . ' ' . substr($phone, strlen($phone) - 10, 3) . ' ' . substr($phone, strlen($phone) - 7, strlen($phone));
    }
}

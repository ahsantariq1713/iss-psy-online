<?php


namespace App\Helpers;


class PartialHide
{
    public static function email($email)
    {
        $em   = explode("@",$email);
        $name = implode('@', array_slice($em, 0, count($em)-1));
        $len  = floor(strlen($name)/2);

        return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);
    }

    public static function phone($phone)
    {
        return substr($phone, 0, 2) . '******' . substr($phone, -2);
    }
}

<?php


namespace App\Helpers;


class Redirectable
{
    public static function getQueryString($request, $component){
        $component->next = $request->next ?? null;
        $component->back = $request->back ?? null;
        $component->skip = $request->skip ?? null;

        if(is_null($component->next)){
            $component->next = $component->back;
            $component->hasNext = true;
        }
    }

    public static function backUrl($component,$defaultRoute){
        return not_null($component->back) ? $component->back : $defaultRoute;
    }

    public static function nextUrl($component,$defaultRoute){

        return not_null($component->next) ? $component->next : $defaultRoute;
    }
}

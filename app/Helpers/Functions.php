<?php

if(!function_exists('not')){
    function not($b)
    {
        return !$b;
    }
}



if(!function_exists('not_null')){
    function not_null($obj)
    {
        return $obj != null;
    }
}

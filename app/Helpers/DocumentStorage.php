<?php


namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class DocumentStorage
{
    public static function store($obj,$property,$doc,$user_id){
        if (!$doc) {
            return null;
        }

        Storage::disk('local')->delete($obj[$property]);

        $obj[$property] = $doc->store('documents/user_' . $user_id , 'local');
    }
}

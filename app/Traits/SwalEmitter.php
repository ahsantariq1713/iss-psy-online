<?php

namespace App\Traits;

trait SwalEmitter
{
    public function swalAlert($icon,$title,$text, $button = 'Ok', $timer = 0){
        $this->emit('redirect',[
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
            'button' => $button,
            'timer' => $timer
        ]);
    }

    public function swalRedirect($icon,$title,$text,$redirect,$options,$timer = 0){
        $this->emit('redirect',[
            'icon' => $icon,
            'title' => $title,
            'text' => $text,
            'redirect' => $redirect,
            'options' => $options,
            'timer' => $timer
        ]);
    }
}

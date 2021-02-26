<?php

namespace App\Models;

use App\Traits\SessionRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Session extends Model
{
    use HasFactory, SessionRelations;
    public $incrementing = false;
    protected $guarded = ['user_id'];

    protected $casts = ['start'=> 'datetime', 'end'=> 'datetime','active'=>'boolean'];

    public function readable(){
        return $this->start->setTimeZone(Auth::user()->timezone)->format('H:i A') . ' - ' . $this->end->setTimeZone(Auth::user()->timezone)->format('H:i A') ;
    }
}

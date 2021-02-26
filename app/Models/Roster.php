<?php

namespace App\Models;

use App\Helpers\UserReadable;
use App\Traits\RosterRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roster extends Model
{
    use HasFactory, RosterRelations;

    protected $guarded = ['id', 'user_id'];

    public function durationHours()
    {
        return $this->duration / 60;
    }

    public function openReadable($tz)
    {
        return  UserReadable::time($this->open, $this->user->timezone, $tz)->format('h:i A');
    }

    public function closeReadable($tz)
    {
        return  UserReadable::time($this->close, $this->user->timezone, $tz)->format('h:i A');
    }
}

<?php


namespace App\Traits;

use App\Models\User;

trait EmergencyPhoneRelations
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

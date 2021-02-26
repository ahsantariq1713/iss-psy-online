<?php

namespace App\Models;

use App\Helpers\PhoneFormatter;
use App\Traits\EmergencyPhoneRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyPhone extends Model
{
    use HasFactory, EmergencyPhoneRelations;

    protected $fillable = ['code', 'phone', 'relation'];

    public function formattedPhone()
    {
        return  '+' . $this->code . ' ' . PhoneFormatter::format($this->phone);
    }
}

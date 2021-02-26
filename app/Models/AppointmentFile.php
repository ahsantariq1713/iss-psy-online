<?php

namespace App\Models;

use App\Traits\AppointmentFileRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentFile extends Model
{
    use HasFactory, AppointmentFileRelations;

    protected $guarded = ['appointment_id', 'user_id', 'id'];

}

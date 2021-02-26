<?php

namespace App\Models;

use App\Traits\PracticeLicenseRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeLicense extends Model
{
    use HasFactory, PracticeLicenseRelations;

    protected $guarded = ['id','user_id'];
}

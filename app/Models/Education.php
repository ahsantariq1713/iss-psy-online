<?php

namespace App\Models;

use App\Traits\EducationRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory, EducationRelations;

    protected $guarded = ['id','user_id'];
}

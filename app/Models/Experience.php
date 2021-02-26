<?php

namespace App\Models;

use App\Traits\ExperienceRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory, ExperienceRelations;

    protected $fillable = ['id', 'user_id'];
}

<?php

namespace App\Models;

use App\Traits\LanguageRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory, LanguageRelations;
}

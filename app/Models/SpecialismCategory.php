<?php

namespace App\Models;

use App\Traits\SpecialismCategoryRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialismCategory extends Model
{
    use HasFactory, SpecialismCategoryRelations;

}

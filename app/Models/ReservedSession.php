<?php

namespace App\Models;

use App\Traits\ReservedSessionRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedSession extends Model
{
    use HasFactory, ReservedSessionRelations;

    protected $guarded = ['id', 'token'];
    protected $hidden = ['token'];
}

<?php

namespace App\Models;

use App\Traits\IdentityRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Identity extends Model
{
    use HasFactory, IdentityRelations;

    protected $guarded = ['id', 'user_id'];

}

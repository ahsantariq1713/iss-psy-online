<?php

namespace App\Models;

use App\Traits\TicketMessageRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory, TicketMessageRelations;
}

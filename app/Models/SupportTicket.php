<?php

namespace App\Models;

use App\Traits\SupportTicketRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    use HasFactory, SupportTicketRelations;
}

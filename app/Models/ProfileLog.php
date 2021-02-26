<?php

namespace App\Models;

use App\Traits\ProfileLogRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLog extends Model
{
    use HasFactory, ProfileLogRelations;
    public const PENDING = "Pending";
    public const UNDER_REVIEW = "Under Review";
    public const APPROVED = "Approved";
    public const DISAPPROVED = "Disapproved";
    protected $guarded = ['id', 'user_id', 'status', 'admin_comments', 'verified_at'];
}

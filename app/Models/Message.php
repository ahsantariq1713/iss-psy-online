<?php

namespace App\Models;

use App\Helpers\UserRoles;
use App\Traits\MessageRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory, MessageRelations;

    protected $guarded = ['id', 'user_id', 'conversation_id'];

    public function outbound($userId)
    {
//        return $this->user->id == Auth::user()->id;
        return $this->user->id == $userId;
    }

    public function content()
    {
        if (strlen($this->content) > 30) {
            return substr($this->content, 0, 29) . '...';
        }

        return $this->content;
    }

    public function markRead()
    {
        $this->read_at = now();
        $this->save();
    }
}

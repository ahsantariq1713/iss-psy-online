<?php

namespace App\Models;

use App\Traits\ConversationRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory, ConversationRelations;

    protected $guarded = ['id', 'client_id', 'therapist_id'];

    public function participant()
    {
        return Auth::user()->role == 'Therapist' ? $this->client : $this->therapist;
    }

    public function unreadMessagesCount()
    {
        return $this->messages->where('read_at', null)->where('user_id', '!=' , Auth::id())->count();
    }

    public function hasUnreadMessages(){
        return $this->unreadMessagesCount() > 0;
    }

    public function lastMessageAgo()
    {
        $first = Message::where('conversation_id', $this->id)->orderBy('created_at', 'desc')->first();
        if (not_null($first)) {
            return $first->created_at->diffForHumans();
        }
        return 'Never';
    }
}

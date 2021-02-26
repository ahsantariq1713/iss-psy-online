<?php

namespace App\Http\Livewire;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NavMessages extends Component
{
    public $hasUnreadMessages = false;

    protected $listeners = ['refreshNav'];
    public function refreshNav(){}

    public function unreadMessages()
    {
        $userKey = strtolower(Auth::user()->role) . '_id';

        $conversationIds = Conversation::where($userKey, Auth::id())->pluck('id')->toArray();
        $messages = Message::with('user')->whereIn('conversation_id',$conversationIds)->where('user_id', '!=',  Auth::id())->where('read_at', null)->get();
        $this->hasUnreadMessages = $messages->count() > 0;
        return $messages;
    }

    public function render()
    {
        $messages = $this->unreadMessages();
        return view('livewire.nav-messages', compact('messages'));
    }
}

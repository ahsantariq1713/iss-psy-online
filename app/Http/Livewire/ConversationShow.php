<?php

namespace App\Http\Livewire;

use App\Events\EchoEvent;
use App\Events\ChatEvent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ConversationShow extends Component
{
    public $conversation, $chatId, $userId,$timezone, $messages, $totalMessages, $content, $height = '500px';

    protected $listeners = ['setHeight', 'messageReceived'];

    public function messageReceived($id){
        $message = Message::find($id);
        $this->messages->push($message);
        $this->emit('scrollToBottom');
    }

    public function mount($therapistId,$clientId, $userId, $id = null){
//        $this->conversation = Conversation::with('messages')->find($id);
        $this->userId = $userId;
        $this->timezone = User::find($userId)->first()->timezone;
        $this->conversation = Conversation::where('client_id', $clientId)->where('therapist_id', $therapistId)->first();
        if(is_null($this->conversation)) abort(404);
        $this->chatId = $this->conversation->id;
        $query  = Message::where('conversation_id', $this->conversation->id)->orderBy('created_at','asc');
        $this->totalMessages = $query->count();
        $this->messages = $query->limit(50)->get();
        $this->emit('scrollToBottom');
    }

    public function send(){
        if(strlen($this->content) <= 0 ) return null;
        //add to database
        $message = new Message(['content' => $this->content]);
        $message->conversation()->associate($this->conversation);
        $message->user()->associate($this->userId);
        $message->save();
        //insert in messges list
        $this->messages->push($message);
        $this->content = null;
        //notify other user

        broadcast(new ChatEvent($this->conversation->id, 'message.received', $message->id))->toOthers();
//        broadcast(new ActivityEvent('user' . $this->conversation->participant()->id, 'refresh.nav'))->toOthers();
        $this->emit('scrollToBottom');
    }

    public function render()
    {
        return view('livewire.conversation-show');
    }
}

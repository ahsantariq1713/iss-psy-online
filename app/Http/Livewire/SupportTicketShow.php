<?php

namespace App\Http\Livewire;

use App\Events\EchoEvent;
use App\Helpers\UserRoles;
use App\Models\SupportTicket;
use App\Models\TicketMessage;
use App\Models\User;
use App\Notifications\UserActivity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SupportTicketShow extends Component
{
    public $ticketId, $message;
    protected $rules = [
        'message' => 'required'
    ];

    public function mount($id)
    {
        $this->ticketId = $id;
    }

    public function addMessage()
    {
        $this->validate();

        $ticket = SupportTicket::find($this->ticketId);

        $message = new TicketMessage();
        $message->content = $this->message;
        $message->user()->associate(Auth::user());
        $message->supportTicket()->associate($ticket);
        $message->save();


        $user = Auth::user()->isAdmin() ? $ticket->user : User::where('role', UserRoles::ADMIN)->first();

        if (Auth::user()->isAdmin()) {
            $ticket->status = 'Awaiting Reply';
        } else {
            $ticket->status = 'Pending';
        }

        $ticket->save();

        $user->notify(new UserActivity([
            'sender' => Auth::user(),
            'titlePostfix' => Auth::user()->name . ' submitted a message against ticket # ' . $this->ticketId,
            'url' => '/support-ticket-details/' . $ticket->id
        ]));
        broadcast(new EchoEvent('user' . $user->id, 'refresh.nav'))->toOthers();
        return redirect('/support-ticket-details/' . $ticket->id);
    }

    public function closeTicket()
    {

        $ticket = SupportTicket::find($this->ticketId);
        $ticket->status = 'Closed';
        $ticket->save();
    }

    public function render()
    {
        $ticket = SupportTicket::with('ticketMessages')->findOrFail($this->ticketId);
        if ($ticket->user_id != Auth::id() && not(Auth::user()->isAdmin())) {
            abort(401);
        }
        return view('livewire.support-ticket-show', compact('ticket'))
            ->extends('layouts.dashboard');
    }
}

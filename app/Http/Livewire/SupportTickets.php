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

class SupportTickets extends Component
{
    public $subject, $message;
    protected $rules = [
        'subject' => 'required',
        'message' => 'required'
    ];

    public function addTicket()
    {

        $this->validate();

        $ticket = new SupportTicket();
        $ticket->subject = $this->subject;
        $ticket->status = 'Pending';
        $ticket->user()->associate(Auth::user());
        $ticket->save();

        $message = new TicketMessage();
        $message->content = $this->message;
        $message->user()->associate(Auth::user());
        $message->supportTicket()->associate($ticket);
        $message->save();

        $user = User::where('role', UserRoles::ADMIN)->first();
        $user->notify(new UserActivity([
            'sender' => Auth::user(),
            'titlePostfix' => Auth::user()->name . ' submitted a support ticket.',
            'url' => '/support-ticket-details/' . $ticket->id
        ]));
        broadcast(new EchoEvent('user' . $user->id, 'refresh.nav'))->toOthers();
        return redirect('/support-ticket-details/' . $ticket->id);
    }

    public function render()
    {
        $tickets = null;
        if (Auth::user()->isAdmin())
            $tickets = SupportTicket::all();
        else
            $tickets = Auth::user()->supportTickets;

        return view('livewire.support-tickets', compact('tickets'))
            ->extends('layouts.dashboard');
    }
}

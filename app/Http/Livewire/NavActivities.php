<?php

namespace App\Http\Livewire;

use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NavActivities extends Component
{
    protected $listeners = ['refreshNav'];
    public function refreshNav(){}

    public function markRead($notification)
    {
        Auth::user()->unreadNotifications->where('id', $notification['id'])->markAsRead();
        return redirect()->to($notification['data']['url']);
    }

    public function render()
    {
        $unread = Auth::user()->unreadNotifications;
        $hasUnread = $unread->count() > 0;
        return view('livewire.nav-activities', compact('unread', 'hasUnread'));
    }
}

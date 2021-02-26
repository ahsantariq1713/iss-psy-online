<?php

namespace App\Http\Livewire;

use App\Helpers\UserRoles;
use App\Models\ProfileLog;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $auth = Auth::user();

        $thCount = [];
        $thCount["incomplete"] =  ProfileLog::where('status', ProfileLog::PENDING)->count();
        $thCount["approved"] =  ProfileLog::where('status', ProfileLog::APPROVED)->count();;
        $thCount["disapproved"] =  ProfileLog::where('status', ProfileLog::DISAPPROVED)->count();;
        $thCount["underReview"] =  ProfileLog::where('status', ProfileLog::UNDER_REVIEW)->count();;

        $clCount = [];
        $clCount['total'] = User::where('role', UserRoles::CLIENT)->count();

        $weekFirstDate = now()->subDay(7);
        $weekLastDate = now();

        $clCount['newThisWeek'] = User::where('role', UserRoles::CLIENT)->whereBetween('created_at', [$weekFirstDate, $weekLastDate])->count();

        return view('livewire.admin-dashboard', compact('auth', 'thCount', 'clCount'));
    }
}

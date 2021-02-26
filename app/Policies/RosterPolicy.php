<?php

namespace App\Policies;

use App\Models\Roster;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RosterPolicy
{
    use HandlesAuthorization;



    public function update(User $user, Roster $roster)
    {
        return $roster->user->is($user);
    }
}

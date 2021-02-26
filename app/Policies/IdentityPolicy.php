<?php

namespace App\Policies;

use App\Models\Identity;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IdentityPolicy
{
    use HandlesAuthorization;


    public function update(User $user, Identity $identity)
    {
        return $identity->user->is($user);
    }

    public function download(User $user, Identity $identity)
    {
        return $identity->user->is($user) || $user->isAdmin();
    }
}

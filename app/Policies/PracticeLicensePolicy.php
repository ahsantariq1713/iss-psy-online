<?php

namespace App\Policies;

use App\Models\PracticeLicense;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PracticeLicensePolicy
{
    use HandlesAuthorization;

    public function update(User $user, PracticeLicense $practiceLicense)
    {
        return $practiceLicense->user->is($user);
    }

    public function download(User $user, PracticeLicense $practiceLicense)
    {
        return $practiceLicense->user->is($user)|| $user->isAdmin();
    }
}

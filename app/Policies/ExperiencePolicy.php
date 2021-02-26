<?php

namespace App\Policies;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExperiencePolicy
{
    use HandlesAuthorization;

    public function update(User $user, Experience $experience)
    {
        return $experience->user->is($user);
    }

    public function delete(User $user, Experience $experience)
    {
        return $experience->user->is($user);
    }
}

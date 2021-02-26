<?php

namespace App\Policies;

use App\Models\Pricing;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PricingPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Pricing $pricing)
    {
        return $pricing->user->is($user);
    }

}

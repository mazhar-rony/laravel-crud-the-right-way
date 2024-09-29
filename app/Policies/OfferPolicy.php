<?php

namespace App\Policies;

use App\Constants\Role;
use App\Models\User;

class OfferPolicy
{
    public function create(User $user)
    {
        return $user->role === Role::USER;
    }

    function viewAny(User $user)
    {
        return $user->role === Role::ADMIN;
    }

    function viewMy(User $user) 
    {
        return $user->role === Role::USER;
    }
}

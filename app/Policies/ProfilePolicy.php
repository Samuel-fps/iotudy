<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Profile;
use App\Models\User;

class ProfilePolicy
{
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Profile $profile): bool
    {
        return $user->id == $profile->user_id;
    }

    public function update(User $user, Profile $profile): bool
    {
        return $user->id == $profile->user_id;
    }

}

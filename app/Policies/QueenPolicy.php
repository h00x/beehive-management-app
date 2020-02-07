<?php

namespace App\Policies;

use App\Queen;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QueenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the queen.
     *
     * @param  \App\User  $user
     * @param  \App\Queen  $queen
     * @return mixed
     */
    public function view(User $user, Queen $queen)
    {
        return $user->is($queen->user);
    }

    /**
     * Determine whether the user can update the queen.
     *
     * @param  \App\User  $user
     * @param  \App\Queen  $queen
     * @return mixed
     */
    public function update(User $user, Queen $queen)
    {
        return $user->is($queen->user);
    }

    /**
     * Determine whether the user can delete the queen.
     *
     * @param  \App\User  $user
     * @param  \App\Queen  $queen
     * @return mixed
     */
    public function delete(User $user, Queen $queen)
    {
        return $user->is($queen->user);
    }
}

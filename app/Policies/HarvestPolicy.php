<?php

namespace App\Policies;

use App\Harvest;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HarvestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the harvest.
     *
     * @param  \App\User  $user
     * @param  \App\Harvest  $harvest
     * @return mixed
     */
    public function view(User $user, Harvest $harvest)
    {
        return $user->is($harvest->user);
    }

    /**
     * Determine whether the user can update the harvest.
     *
     * @param  \App\User  $user
     * @param  \App\Harvest  $harvest
     * @return mixed
     */
    public function update(User $user, Harvest $harvest)
    {
        return $user->is($harvest->user);
    }

    /**
     * Determine whether the user can delete the harvest.
     *
     * @param  \App\User  $user
     * @param  \App\Harvest  $harvest
     * @return mixed
     */
    public function delete(User $user, Harvest $harvest)
    {
        return $user->is($harvest->user);
    }
}

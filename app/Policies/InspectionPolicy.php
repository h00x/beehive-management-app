<?php

namespace App\Policies;

use App\Inspection;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InspectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the inspection.
     *
     * @param  \App\User  $user
     * @param  \App\Inspection  $inspection
     * @return mixed
     */
    public function view(User $user, Inspection $inspection)
    {
        return $user->is($inspection->user);
    }

    /**
     * Determine whether the user can update the inspection.
     *
     * @param  \App\User  $user
     * @param  \App\Inspection  $inspection
     * @return mixed
     */
    public function update(User $user, Inspection $inspection)
    {
        return $user->is($inspection->user);
    }

    /**
     * Determine whether the user can delete the inspection.
     *
     * @param  \App\User  $user
     * @param  \App\Inspection  $inspection
     * @return mixed
     */
    public function delete(User $user, Inspection $inspection)
    {
        return $user->is($inspection->user);
    }
}

<?php

namespace App\Policies;

use App\Inspection;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InspectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any inspections.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the inspection.
     *
     * @param  \App\User  $user
     * @param  \App\Inspection  $inspection
     * @return mixed
     */
    public function view(User $user, Inspection $inspection)
    {
        //
    }

    /**
     * Determine whether the user can create inspections.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
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
        //
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
        //
    }

    /**
     * Determine whether the user can restore the inspection.
     *
     * @param  \App\User  $user
     * @param  \App\Inspection  $inspection
     * @return mixed
     */
    public function restore(User $user, Inspection $inspection)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the inspection.
     *
     * @param  \App\User  $user
     * @param  \App\Inspection  $inspection
     * @return mixed
     */
    public function forceDelete(User $user, Inspection $inspection)
    {
        //
    }
}

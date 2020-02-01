<?php

namespace App\Policies;

use App\Hive;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HivePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any hives.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the hive.
     *
     * @param  \App\User  $user
     * @param  \App\Hive  $hive
     * @return mixed
     */
    public function view(User $user, Hive $hive)
    {
        return $user->is($hive->user);
    }

    /**
     * Determine whether the user can create hives.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the hive.
     *
     * @param  \App\User  $user
     * @param  \App\Hive  $hive
     * @return mixed
     */
    public function update(User $user, Hive $hive)
    {
        return $user->is($hive->user);
    }

    /**
     * Determine whether the user can delete the hive.
     *
     * @param  \App\User  $user
     * @param  \App\Hive  $hive
     * @return mixed
     */
    public function delete(User $user, Hive $hive)
    {
        return $user->is($hive->user);
    }

    /**
     * Determine whether the user can restore the hive.
     *
     * @param  \App\User  $user
     * @param  \App\Hive  $hive
     * @return mixed
     */
    public function restore(User $user, Hive $hive)
    {
        return $user->is($hive->user);
    }

    /**
     * Determine whether the user can permanently delete the hive.
     *
     * @param  \App\User  $user
     * @param  \App\Hive  $hive
     * @return mixed
     */
    public function forceDelete(User $user, Hive $hive)
    {
        return $user->is($hive->user);
    }
}

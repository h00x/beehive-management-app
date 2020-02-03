<?php

namespace App\Policies;

use App\HiveType;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HiveTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any hive types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the hive type.
     *
     * @param  \App\User  $user
     * @param  \App\HiveType  $hiveType
     * @return mixed
     */
    public function view(User $user, HiveType $hiveType)
    {
        return $user->is($hiveType->user);
    }

    /**
     * Determine whether the user can create hive types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the hive type.
     *
     * @param  \App\User  $user
     * @param  \App\HiveType  $hiveType
     * @return mixed
     */
    public function update(User $user, HiveType $hiveType)
    {
        return $user->is($hiveType->user);
    }

    /**
     * Determine whether the user can delete the hive type.
     *
     * @param  \App\User  $user
     * @param  \App\HiveType  $hiveType
     * @return mixed
     */
    public function delete(User $user, HiveType $hiveType)
    {
        return $user->is($hiveType->user);
    }

    /**
     * Determine whether the user can restore the hive type.
     *
     * @param  \App\User  $user
     * @param  \App\HiveType  $hiveType
     * @return mixed
     */
    public function restore(User $user, HiveType $hiveType)
    {
        return $user->is($hiveType->user);
    }

    /**
     * Determine whether the user can permanently delete the hive type.
     *
     * @param  \App\User  $user
     * @param  \App\HiveType  $hiveType
     * @return mixed
     */
    public function forceDelete(User $user, HiveType $hiveType)
    {
        return $user->is($hiveType->user);
    }
}

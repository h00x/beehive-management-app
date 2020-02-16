<?php

namespace App\Policies;

use App\HiveType;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HiveTypePolicy
{
    use HandlesAuthorization;

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
     * Determine whether the user can update the hive type.
     *
     * @param  \App\User  $user
     * @param  \App\HiveType  $hiveType
     * @return mixed
     */
    public function update(User $user, HiveType $hiveType)
    {
        if ($hiveType->protected) {
            return false;
        }

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
        if ($hiveType->protected) {
            return false;
        }

        return $user->is($hiveType->user);
    }
}

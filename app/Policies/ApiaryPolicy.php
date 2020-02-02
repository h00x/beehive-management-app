<?php

namespace App\Policies;

use App\Apiary;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApiaryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any apiaries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the apiary.
     *
     * @param  \App\User  $user
     * @param  \App\Apiary  $apiary
     * @return mixed
     */
    public function view(User $user, Apiary $apiary)
    {
        return $user->is($apiary->user);
    }

    /**
     * Determine whether the user can create apiaries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the apiary.
     *
     * @param  \App\User  $user
     * @param  \App\Apiary  $apiary
     * @return mixed
     */
    public function update(User $user, Apiary $apiary)
    {
        return $user->is($apiary->user);
    }

    /**
     * Determine whether the user can delete the apiary.
     *
     * @param  \App\User  $user
     * @param  \App\Apiary  $apiary
     * @return mixed
     */
    public function delete(User $user, Apiary $apiary)
    {
        return $user->is($apiary->user);
    }

    /**
     * Determine whether the user can restore the apiary.
     *
     * @param  \App\User  $user
     * @param  \App\Apiary  $apiary
     * @return mixed
     */
    public function restore(User $user, Apiary $apiary)
    {
        return $user->is($apiary->user);
    }

    /**
     * Determine whether the user can permanently delete the apiary.
     *
     * @param  \App\User  $user
     * @param  \App\Apiary  $apiary
     * @return mixed
     */
    public function forceDelete(User $user, Apiary $apiary)
    {
        return $user->is($apiary->user);
    }
}

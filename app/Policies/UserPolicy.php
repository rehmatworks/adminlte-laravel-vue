<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function before(User $user)
    {
        if($user->hasRole(env('SUPER_ADMIN_ROLE_NAME')))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->can('manage-users');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return ($user->id == $model->id) || ($user->can('manage-users') && !$model->hasRole(env('SUPER_ADMIN_ROLE_NAME')));
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return ($user->id == $model->id) || ($user->can('manage-users') && !$model->hasRole(env('SUPER_ADMIN_ROLE_NAME')));
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return ($user->id == $model->id) || ($user->can('manage-users') && !$model->hasRole(env('SUPER_ADMIN_ROLE_NAME')));
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return ($user->id == $model->id) || ($user->can('manage-users') && !$model->hasRole(env('SUPER_ADMIN_ROLE_NAME')));
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function restore(User $user, User $model)
    {
        return ($user->id == $model->id) || ($user->can('manage-users') && !$model->hasRole(env('SUPER_ADMIN_ROLE_NAME')));
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\User  $model
     * @return mixed
     */
    public function forceDelete(User $user, User $model)
    {
        return ($user->id == $model->id) || ($user->can('manage-users') && !$model->hasRole(env('SUPER_ADMIN_ROLE_NAME')));
    }
}

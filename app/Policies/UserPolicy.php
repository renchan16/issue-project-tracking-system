<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models (list users).
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user The authenticated user
     * @param  \App\Models\User  $model The user being viewed (not really used here, included for consistency)
     * @return bool
     */
    public function view(User $user, User $model): bool
    {
        // Allow viewing profile details if needed later, but management viewAny is key
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return bool
     */
    public function create(User $user): bool
    {
        // Usually handled by registration, not direct creation by admin here
        return false;
    }

    /**
     * Determine whether the user can update the model (change role).
     *
     * @param  \App\Models\User  $user The authenticated user performing the action
     * @param  \App\Models\User  $model The user whose role is being changed
     * @return bool
     */
    public function update(User $user, User $model): bool
    {
        // Prevent users from updating their own role
        if ($user->id === $model->id) {
            return false;
        }

        // Allow admin or manager to update others
        return $user->isAdmin() || $user->isManager();
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return bool
     */
    public function delete(User $user, User $model): bool
    {
        // Prevent deleting self, only admin can delete others
        return $user->isAdmin() && $user->id !== $model->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $model): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $model): bool
    {
        return false;
    }
}

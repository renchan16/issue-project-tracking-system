<?php

namespace App\Policies;

use App\Models\Issue;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class IssuePolicy
{
    use HandlesAuthorization;

    /**
     * Allow admin and manager full access to issues (within their scope if applicable later).
     */
    public function before(User $user, string $ability): ?bool
    {
        if ($user->isAdmin() || $user->isManager()) {
            return true;
        }
        return null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Allow Admin, Manager, Developer
        return $user->isAdmin() || $user->isManager() || $user->isDeveloper();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Issue $issue): bool
    {
        // Allow Admin, Manager, Developer (Could add project/issue-specific logic later)
        return $user->isAdmin() || $user->isManager() || $user->isDeveloper();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Admins/Managers handled by before(). Allow developer.
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Issue $issue): bool
    {
        // Admins/Managers handled by before(). Allow developer.
        // We are simplifying here - previously reporter/assignee could also update.
        // If more granular control is needed, this logic can be expanded.
        return $user->isDeveloper();
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Issue $issue): bool
    {
        // Admins/Managers handled by before(). No other role should delete.
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Issue $issue): bool
    {
        return false; // Or implement if needed
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Issue $issue): bool
    {
        return false; // Or implement if needed
    }
}

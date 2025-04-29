<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class UserManagementController extends Controller
{
    // Define the available roles
    protected $roles = ['admin', 'manager', 'developer', 'reporter', 'viewer'];

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $this->authorize('viewAny', User::class); // Check UserPolicy@viewAny

        $users = User::orderBy('name')->paginate(15);
        return view('management.users.index', ['users' => $users, 'roles' => $this->roles]);
    }

    /**
     * Update the specified user's role.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateRole(Request $request, User $user)
    {
        $this->authorize('update', $user); // Check UserPolicy@update (Admin or Manager updating someone else)

        $validated = $request->validate([
            'role' => ['required', Rule::in($this->roles)],
        ]);

        $currentUser = auth()->user();
        $requestedRole = $validated['role'];

        // Prevent Managers from assigning Admin or Manager roles
        if ($currentUser->isManager() && ($requestedRole === 'admin' || $requestedRole === 'manager')) {
            return back()->with('error', 'Managers cannot assign Admin or Manager roles.')->withInput();
        }

        // Self-change check (redundant with policy, but safe)
        if ($currentUser->id === $user->id) {
            return back()->with('error', 'You cannot change your own role.');
        }

        $user->update($validated);

        return redirect()->route('admin.users.index')
                         ->with('success', "User '{$user->name}' role updated successfully to {$requestedRole}.");
    }

    // Add destroy method later if needed
    // public function destroy(User $user) { ... }
}

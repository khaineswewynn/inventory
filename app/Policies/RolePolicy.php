<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function viewRole(User $user, Role $role)
    {
        // Admins can see all roles
        if ($user->role->roles === 'Admin') {
            return true;
        }

        // Managers can see all roles except 'admin'
        return $role->roles !== 'Admin';
    }
}

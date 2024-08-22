<?php

namespace App\Policies;

use App\Models\Apbd;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ApbdPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isActive;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Apbd $apbd): bool
    {
        return $user->isActive;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Apbd $apbd): bool
    {
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Apbd $apbd): bool
    {
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Apbd $apbd): bool
    {
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Apbd $apbd): bool
    {
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }
}

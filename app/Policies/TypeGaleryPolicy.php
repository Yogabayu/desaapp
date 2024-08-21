<?php

namespace App\Policies;

use App\Models\TypeGalery;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TypeGaleryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Any active user can view any TypeGalery
        return $user->isActive;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TypeGalery $typeGalery): bool
    {
        // Any active user can view a TypeGalery
        return $user->isActive;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Only users with the 'admin' or 'editor' role can create TypeGalery
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, TypeGalery $typeGalery): bool
    {
        // Only users with the 'admin' or 'editor' role can update a TypeGalery
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TypeGalery $typeGalery): bool
    {
        // Only users with the 'admin' role can delete a TypeGalery
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TypeGalery $typeGalery): bool
    {
        // Only users with the 'admin' role can restore a TypeGalery
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TypeGalery $typeGalery): bool
    {
        // Only users with the 'admin' role can permanently delete a TypeGalery
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }
}
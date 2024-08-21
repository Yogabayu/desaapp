<?php

namespace App\Policies;

use App\Models\User;
use App\Models\VillageGallery;
use Illuminate\Auth\Access\Response;

class VillageGalleryPolicy
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
    public function view(User $user, VillageGallery $villageGallery): bool
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
    public function update(User $user, VillageGallery $villageGallery): bool
    {
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, VillageGallery $villageGallery): bool
    {
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, VillageGallery $villageGallery): bool
    {
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, VillageGallery $villageGallery): bool
    {
        return $user->isActive && ($user->role->name === 'Super Admin' || $user->role->name === 'Admin');
    }
}

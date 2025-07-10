<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\RadiologyTest;
use App\Models\User;

class RadiologyTestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any RadiologyTest');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RadiologyTest $radiologytest): bool
    {
        return $user->checkPermissionTo('view RadiologyTest');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create RadiologyTest');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RadiologyTest $radiologytest): bool
    {
        return $user->checkPermissionTo('update RadiologyTest');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RadiologyTest $radiologytest): bool
    {
        return $user->checkPermissionTo('delete RadiologyTest');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any RadiologyTest');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RadiologyTest $radiologytest): bool
    {
        return $user->checkPermissionTo('restore RadiologyTest');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any RadiologyTest');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, RadiologyTest $radiologytest): bool
    {
        return $user->checkPermissionTo('replicate RadiologyTest');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder RadiologyTest');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RadiologyTest $radiologytest): bool
    {
        return $user->checkPermissionTo('force-delete RadiologyTest');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any RadiologyTest');
    }
}

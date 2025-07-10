<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\PathologyTest;
use App\Models\User;

class PathologyTestPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any PathologyTest');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PathologyTest $pathologytest): bool
    {
        return $user->checkPermissionTo('view PathologyTest');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create PathologyTest');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PathologyTest $pathologytest): bool
    {
        return $user->checkPermissionTo('update PathologyTest');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PathologyTest $pathologytest): bool
    {
        return $user->checkPermissionTo('delete PathologyTest');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any PathologyTest');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PathologyTest $pathologytest): bool
    {
        return $user->checkPermissionTo('restore PathologyTest');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any PathologyTest');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, PathologyTest $pathologytest): bool
    {
        return $user->checkPermissionTo('replicate PathologyTest');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder PathologyTest');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PathologyTest $pathologytest): bool
    {
        return $user->checkPermissionTo('force-delete PathologyTest');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any PathologyTest');
    }
}

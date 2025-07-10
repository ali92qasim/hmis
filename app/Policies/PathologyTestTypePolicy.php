<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\PathologyTestType;
use App\Models\User;

class PathologyTestTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any PathologyTestType');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, PathologyTestType $pathologytesttype): bool
    {
        return $user->checkPermissionTo('view PathologyTestType');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create PathologyTestType');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, PathologyTestType $pathologytesttype): bool
    {
        return $user->checkPermissionTo('update PathologyTestType');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PathologyTestType $pathologytesttype): bool
    {
        return $user->checkPermissionTo('delete PathologyTestType');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any PathologyTestType');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, PathologyTestType $pathologytesttype): bool
    {
        return $user->checkPermissionTo('restore PathologyTestType');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any PathologyTestType');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, PathologyTestType $pathologytesttype): bool
    {
        return $user->checkPermissionTo('replicate PathologyTestType');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder PathologyTestType');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, PathologyTestType $pathologytesttype): bool
    {
        return $user->checkPermissionTo('force-delete PathologyTestType');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any PathologyTestType');
    }
}

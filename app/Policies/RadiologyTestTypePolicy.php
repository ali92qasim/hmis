<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\RadiologyTestType;
use App\Models\User;

class RadiologyTestTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any RadiologyTestType');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, RadiologyTestType $radiologytesttype): bool
    {
        return $user->checkPermissionTo('view RadiologyTestType');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create RadiologyTestType');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, RadiologyTestType $radiologytesttype): bool
    {
        return $user->checkPermissionTo('update RadiologyTestType');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, RadiologyTestType $radiologytesttype): bool
    {
        return $user->checkPermissionTo('delete RadiologyTestType');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any RadiologyTestType');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, RadiologyTestType $radiologytesttype): bool
    {
        return $user->checkPermissionTo('restore RadiologyTestType');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any RadiologyTestType');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, RadiologyTestType $radiologytesttype): bool
    {
        return $user->checkPermissionTo('replicate RadiologyTestType');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder RadiologyTestType');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, RadiologyTestType $radiologytesttype): bool
    {
        return $user->checkPermissionTo('force-delete RadiologyTestType');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any RadiologyTestType');
    }
}

<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\BillingType;
use App\Models\User;

class BillingTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->checkPermissionTo('view-any BillingType');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BillingType $billingtype): bool
    {
        return $user->checkPermissionTo('view BillingType');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->checkPermissionTo('create BillingType');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BillingType $billingtype): bool
    {
        return $user->checkPermissionTo('update BillingType');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BillingType $billingtype): bool
    {
        return $user->checkPermissionTo('delete BillingType');
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->checkPermissionTo('delete-any BillingType');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BillingType $billingtype): bool
    {
        return $user->checkPermissionTo('restore BillingType');
    }

    /**
     * Determine whether the user can restore any models.
     */
    public function restoreAny(User $user): bool
    {
        return $user->checkPermissionTo('restore-any BillingType');
    }

    /**
     * Determine whether the user can replicate the model.
     */
    public function replicate(User $user, BillingType $billingtype): bool
    {
        return $user->checkPermissionTo('replicate BillingType');
    }

    /**
     * Determine whether the user can reorder the models.
     */
    public function reorder(User $user): bool
    {
        return $user->checkPermissionTo('reorder BillingType');
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BillingType $billingtype): bool
    {
        return $user->checkPermissionTo('force-delete BillingType');
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->checkPermissionTo('force-delete-any BillingType');
    }
}

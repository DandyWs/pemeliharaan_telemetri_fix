<?php

namespace App\Policies;

use App\Models\User;
use App\Models\FormKomponen;
use Illuminate\Auth\Access\HandlesAuthorization;

class FormKomponenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the formKomponen can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the formKomponen can view the model.
     */
    public function view(User $user, FormKomponen $model): bool
    {
        return true;
    }

    /**
     * Determine whether the formKomponen can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the formKomponen can update the model.
     */
    public function update(User $user, FormKomponen $model): bool
    {
        return true;
    }

    /**
     * Determine whether the formKomponen can delete the model.
     */
    public function delete(User $user, FormKomponen $model): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     */
    public function deleteAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the formKomponen can restore the model.
     */
    public function restore(User $user, FormKomponen $model): bool
    {
        return false;
    }

    /**
     * Determine whether the formKomponen can permanently delete the model.
     */
    public function forceDelete(User $user, FormKomponen $model): bool
    {
        return false;
    }
}

<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JenisAlat;
use Illuminate\Auth\Access\HandlesAuthorization;

class JenisAlatPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the jenisAlat can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the jenisAlat can view the model.
     */
    public function view(User $user, JenisAlat $model): bool
    {
        return true;
    }

    /**
     * Determine whether the jenisAlat can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the jenisAlat can update the model.
     */
    public function update(User $user, JenisAlat $model): bool
    {
        return true;
    }

    /**
     * Determine whether the jenisAlat can delete the model.
     */
    public function delete(User $user, JenisAlat $model): bool
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
     * Determine whether the jenisAlat can restore the model.
     */
    public function restore(User $user, JenisAlat $model): bool
    {
        return false;
    }

    /**
     * Determine whether the jenisAlat can permanently delete the model.
     */
    public function forceDelete(User $user, JenisAlat $model): bool
    {
        return false;
    }
}

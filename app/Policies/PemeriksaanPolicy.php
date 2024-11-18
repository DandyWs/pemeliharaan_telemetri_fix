<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Pemeriksaan;
use Illuminate\Auth\Access\HandlesAuthorization;

class PemeriksaanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the pemeriksaan can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the pemeriksaan can view the model.
     */
    public function view(User $user, Pemeriksaan $model): bool
    {
        return true;
    }

    /**
     * Determine whether the pemeriksaan can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the pemeriksaan can update the model.
     */
    public function update(User $user, Pemeriksaan $model): bool
    {
        return true;
    }

    /**
     * Determine whether the pemeriksaan can delete the model.
     */
    public function delete(User $user, Pemeriksaan $model): bool
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
     * Determine whether the pemeriksaan can restore the model.
     */
    public function restore(User $user, Pemeriksaan $model): bool
    {
        return false;
    }

    /**
     * Determine whether the pemeriksaan can permanently delete the model.
     */
    public function forceDelete(User $user, Pemeriksaan $model): bool
    {
        return false;
    }
}

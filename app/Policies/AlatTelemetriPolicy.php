<?php

namespace App\Policies;

use App\Models\User;
use App\Models\AlatTelemetri;
use Illuminate\Auth\Access\HandlesAuthorization;

class AlatTelemetriPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the alatTelemetri can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the alatTelemetri can view the model.
     */
    public function view(User $user, AlatTelemetri $model): bool
    {
        return true;
    }

    /**
     * Determine whether the alatTelemetri can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the alatTelemetri can update the model.
     */
    public function update(User $user, AlatTelemetri $model): bool
    {
        return true;
    }

    /**
     * Determine whether the alatTelemetri can delete the model.
     */
    public function delete(User $user, AlatTelemetri $model): bool
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
     * Determine whether the alatTelemetri can restore the model.
     */
    public function restore(User $user, AlatTelemetri $model): bool
    {
        return false;
    }

    /**
     * Determine whether the alatTelemetri can permanently delete the model.
     */
    public function forceDelete(User $user, AlatTelemetri $model): bool
    {
        return false;
    }
}

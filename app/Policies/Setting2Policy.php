<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Setting2;
use Illuminate\Auth\Access\HandlesAuthorization;

class Setting2Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the setting2 can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the setting2 can view the model.
     */
    public function view(User $user, Setting2 $model): bool
    {
        return true;
    }

    /**
     * Determine whether the setting2 can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the setting2 can update the model.
     */
    public function update(User $user, Setting2 $model): bool
    {
        return true;
    }

    /**
     * Determine whether the setting2 can delete the model.
     */
    public function delete(User $user, Setting2 $model): bool
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
     * Determine whether the setting2 can restore the model.
     */
    public function restore(User $user, Setting2 $model): bool
    {
        return false;
    }

    /**
     * Determine whether the setting2 can permanently delete the model.
     */
    public function forceDelete(User $user, Setting2 $model): bool
    {
        return false;
    }
}

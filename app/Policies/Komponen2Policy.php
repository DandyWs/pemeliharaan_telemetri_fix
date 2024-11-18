<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Komponen2;
use Illuminate\Auth\Access\HandlesAuthorization;

class Komponen2Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the komponen2 can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the komponen2 can view the model.
     */
    public function view(User $user, Komponen2 $model): bool
    {
        return true;
    }

    /**
     * Determine whether the komponen2 can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the komponen2 can update the model.
     */
    public function update(User $user, Komponen2 $model): bool
    {
        return true;
    }

    /**
     * Determine whether the komponen2 can delete the model.
     */
    public function delete(User $user, Komponen2 $model): bool
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
     * Determine whether the komponen2 can restore the model.
     */
    public function restore(User $user, Komponen2 $model): bool
    {
        return false;
    }

    /**
     * Determine whether the komponen2 can permanently delete the model.
     */
    public function forceDelete(User $user, Komponen2 $model): bool
    {
        return false;
    }
}

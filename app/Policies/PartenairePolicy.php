<?php

namespace App\Policies;

use App\Models\Partenaire;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PartenairePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $partenaire): bool
    {
        return $user->id == $partenaire->id or $user->isAdmin();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $partenaire): bool
    {
        return $user->id == $partenaire->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $partenaire): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, User $partenaire): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, User $partenaire): bool
    {
        //
    }
}

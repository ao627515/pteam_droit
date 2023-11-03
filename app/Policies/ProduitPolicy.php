<?php

namespace App\Policies;

use App\Models\Produit;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProduitPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user)
    {
        return  true
            ? Response::allow()
            : Response::deny('You must be an administrator.');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Produit $produit)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->isAdmin() or $user->isPartenaire();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Produit $produit)
    {
        return $user->id == $produit->author_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Produit $produit)
    {
        return $user->isAdmin() or $user->isPartenaire();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Produit $produit)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Produit $produit)
    {
        return $user->isAdmin();
    }
}

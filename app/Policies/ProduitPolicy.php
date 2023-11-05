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
        return $user->isAdmin() or $user->isPartenaire();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user,  $produit)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->isAdmin() or $user->isPartenaire()
            ? Response::allow()
            : Response::deny("Vous n'avez pas le droit de créé un produit");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Produit $produit)
    {
        return $user->id == $produit->author_id
            ? Response::allow()
            : Response::deny("Vous n'avez pas le droit de modifié cet produit");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Produit $produit)
    {
        return $user->isAdmin() or $user->isPartenaire()
            ? Response::allow()
            : Response::deny("Vous n'avez pas le droit de supprimé cet produit");
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
    public function approuved(User $user, Produit $produit)
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny("Vous n'ête pas authorisé à approuvé un produit");
    }

    public function declined(User $user, Produit $produit)
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny("Vous n'ête pas authorisé à decliné un produit");
    }

    public function relaunch(User $user, Produit $produit)
    {
        return $user->id == $produit->author_id
            ? Response::allow()
            : Response::deny("Vous n'avez pas le droit de faire une demande publication pour cet produit");
    }

    public function publish(User $user, Produit $produit)
    {
        return $user->id == $produit->author_id
            ? Response::allow()
            : Response::deny("Vous n'avez pas le droit de publié cet produit");
    }
}

<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
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
    public function view(User $user, Article $article)
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
            : Response::deny("Vous n'avez pas le droit de créé un article");
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article)
    {
        return $user->id == $article->author_id
            ? Response::allow()
            : Response::deny("Vous n'avez pas le droit de modifié cet article");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Article $article)
    {
        return $user->isAdmin() or $user->isPartenaire()
            ? Response::allow()
            : Response::deny("Vous n'avez pas le droit de supprimé cet article");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Article $article)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function approuved(User $user, Article $article)
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny("Vous n'ête pas authorisé à approuvé un article");
    }

    public function declined(User $user, Article $article)
    {
        return $user->isAdmin()
            ? Response::allow()
            : Response::deny("Vous n'ête pas authorisé à decliné un article");
    }

    public function relaunch(User $user, Article $article)
    {
        return $user->id == $article->author_id
            ? Response::allow()
            : Response::deny("Vous n'avez pas le droit de faire une demande publication pour cet article");
    }

    public function publish(User $user, Article $article)
    {
        return $user->id == $article->author_id
            ? Response::allow()
            : Response::deny("Vous n'avez pas le droit de publié cet article");
    }
}

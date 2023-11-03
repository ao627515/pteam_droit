<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait StatusTrait
{

    public function adminArticleStatus()
    {
        // Si ce n'est pas approuvé mais décliné
        switch ($this->status) {
            case 1:
                return 'Demande de publication';
                break;
            case 2:
                return 'Article publier';
                break;
            case 3:
                return 'Article decliné';
                break;
            case 4:
                return 'Demande de suppression';
                break;
        }
    }

    public function partenaireArticleStatus()
    {
        switch ($this->status) {
            case 1:
                return 'En attente';
                break;
            case 2:
                return 'Article publier';
                break;
            case 3:
                return 'Article decliner';
                break;
            case 4:
                return 'En attente';
                break;
            case 5:
                return 'Brouillons';
                break;
        }
    }

    public function getArticleStatus()
    {
        if (auth()->user()->isAdmin()) {
            return $this->adminArticleStatus();
        } else {
            return $this->partenaireArticleStatus();
        }
    }

    public function adminProduitStatus()
    {
        // Si ce n'est pas approuvé mais décliné
        switch ($this->status) {
            case 1:
                return 'Demande de publication';
                break;
            case 2:
                return 'Produit publier';
                break;
            case 3:
                return 'Produit decliner';
                break;
            case 4:
                return 'Demande de suppression';
                break;
        }
    }

    public function partenaireProduitStatus()
    {
        switch ($this->status) {
            case 1:
            case 4:
                return 'En attente';
                break;
            case 2:
                return 'Produit publier';
                break;
            case 3:
                return 'Produit decliner';
                break;
            case 5:
                return 'Brouillons';
                break;
        }
    }

    public function getProduitStatus()
    {
        if (auth()->user()->isAdmin()) {
            return $this->adminProduitStatus();
        } else {
            return $this->partenaireProduitStatus();
        }
    }

    public function partenaireStatus()
    {
        switch ($this->status) {
            case 1:
                return "Demande d'inscription";
                break;
            case 2:
                return 'Inscrit';
                break;
            case 3:
                return 'Décliner';
                break;
            default:
                return 'Statut inconnue';
                break;
        }
    }

    public function isStandby()
    {
        return $this->status === 1;
    }

    public function isDraft()
    {
        return $this->status === 5;
    }

    public function isDeclined()
    {
        return $this->status === 3;
    }

    public function isApprove()
    {
        return $this->status === 2;
    }
}

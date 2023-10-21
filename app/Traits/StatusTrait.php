<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait StatusTrait
{
    public function adminStatus()
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

    public function partenaireStatus()
    {
        switch ($this->status) {
            case 1:
                return 'En attente';
                break;
            case 2:
                return 'Article publier';
                break;
            case 3:
                return 'Article decliné';
                break;
            case 4:
                return 'En attente';
                break;
            case 5:
                return 'Brouillons';
                break;
        }
    }

    public function getStatus()
    {
        if (auth()->user()->role == 'administrateur') {
            return $this->adminStatus();
        } else {
            return $this->partenaireStatus();
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

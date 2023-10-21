<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class Produit extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = [''];

    public function imgInit() {

        if(!$this->IsFactory())
        {
            $this->image = $this->imageLink();
        }
    }

    public function imageLink(): string{
        return Storage::url($this->image);
    }

    public function author () {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function approuvedBy () {
        return $this->belongsTo(User::class, 'approuved_by');
    }

    public function declinedBy()
    {
        return $this->belongsTo(User::class, 'declined_by');
    }

    // public function categorie () {
    //     return $this->belongsTo(User::class, 'categorie_produit_id');
    // }

    public function IsFactory(): bool{
        return Str::startsWith($this->image, 'https');
    }

    public static function produitsAprouved(int $paginate = null, int $limit = null): Collection|LengthAwarePaginator|null
    {
        return Produit::where('active', true)
            ->whereNotNull('approuved_at')
            ->whereNotNull('approuved_by')
            ->when($limit, function ($query) use ($limit){
                return $query->limit($limit);
            })
            ->when(!$paginate, function ($query){
                return $query->get();
            })
            ->when($paginate, function ($query) use ($paginate){
                return $query->paginate($paginate);
            });
    }

    public static function produitsDelete(): Collection|null {
        return Produit::where('active', false)
                        ->get();
    }

    public static function produitsNonTraite(): Collection|null {
        return Produit::where('approuved_at', null, 'and', 'approuved_by', null)
                        ->get();
    }

    public function publishDate()
    {
        $carbone = new Carbon($this->approuved_at);

        return $carbone->format('j M Y');
    }

    public  function publishDateTime()
    {
        $carbone = new Carbon($this->approuved_at);

        return $carbone->format('j M Y à H\h i');
    }

    public static function date($date)
    {

        $carbone = new Carbon($date);

        return $carbone->format('j M Y');
    }

    public static function dateTime($datetime)
    {

        $carbone = new Carbon($datetime);

        return $carbone->format('j M Y à H\h i');
    }


    private function adminStatus()
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
                return 'Produit decliné';
                break;
            case 4:
                return 'Demande de suppression';
                break;
        }
    }

    private function partenaireStatus()
    {
        switch ($this->status) {
            case 1:
                return 'En attente';
                break;
            case 2:
                return 'Produit publier';
                break;
            case 3:
                return 'Produit decliné';
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

    public function isApprove()
    {
        return $this->status === 2;
    }

    public function getActionDate()
    {
        switch ($this->status) {
            case 1:
            case 5:
                return 'Créer le : ' . Produit::date($this->created_at);
                break;
            case 2:
                return 'Publié le : ' . Produit::date($this->created_at);
                break;
            case 3:
                return 'Décliné le : ' . Produit::date($this->created_at);
                break;
        }
    }
}

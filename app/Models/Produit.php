<?php

namespace App\Models;

use App\Models\User;
use App\Traits\StatusTrait;
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
    use HasFactory, Notifiable, StatusTrait;

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

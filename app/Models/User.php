<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use App\Traits\StatusTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, StatusTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [''];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function prestations() {

        if($this->role == "partenaire"){
            return $this->belongsToMany(Prestation::class, "prestation_user", 'user_id', 'prestation_id');
        }

        return "Vous n'avez pas droit a des prestation";
    }

    public function organisation(){
        return $this->hasOne(Organisation::class, 'user_id');
    }

    public function articles(){
        return $this->hasMany(Article::class, 'author_id');
    }

    public function produits(){
        return $this->hasMany(Produit::class, 'author_id');
    }


    public function isPartenaire(){
        return $this->role === "partenaire";
    }

    public function isAdmin(){
        return $this->role === "administrateur";
    }

    public function isUser(){
        return $this->role === "utilisateur";
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
                return 'Créer le : ' . User::date($this->created_at);
                break;
            case 2:
                return 'Inscrit le : ' . User::date($this->created_at);
                break;
            case 3:
                return 'Décliné le : ' . User::date($this->created_at);
                break;
        }
    }
}

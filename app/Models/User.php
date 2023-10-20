<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'phone',
        'email',
        'password',
        'role',
        'type_compte',
        'approuved_by',
        'approuved_at',
    ];

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
}

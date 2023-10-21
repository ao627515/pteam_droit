<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function domaine(){
        return $this->belongsTo(Domaine::class, 'domaine_id');
    }

    public function owner(){
        return $this->belongsTo(Domaine::class, 'user_id');
    }
}

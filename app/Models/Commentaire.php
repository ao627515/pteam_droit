<?php

namespace App\Models;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commentaire extends Model
{
    use HasFactory;
    protected $fillable=[
        'contenu',
        'ticket_id',
        'non_lu'
    ];

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\Domaine;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organisation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function imgInit()
    {
        if (!$this->IsFactory()) {
            $this->logo = $this->imageLink();
        }
    }

    private function imageLink(): string
    {
        return Storage::url($this->logo);
    }

    public function IsFactory(): bool
    {
        return Str::startsWith($this->logo, 'https');
    }

    public function domaine(){
        return $this->belongsTo(Domaine::class, 'domaine_id');
    }

    public function owner(){
        return $this->belongsTo(User::class, 'user_id');
    }
}

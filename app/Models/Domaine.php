<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domaine extends Model
{
    use HasFactory;

    protected $guarded = [''];

    public function imgInit()
    {

        if (!$this->IsFactory()) {
            $this->icon = $this->imageLink();
        }
    }
    private function imageLink(): string
    {
        return Storage::url($this->icon);
    }
    public function IsFactory(): bool
    {
        return Str::startsWith($this->icon, 'https');
    }
}

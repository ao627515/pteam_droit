<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory;
    protected $guarded = [''];

    public function imageLink(){
        return Storage::disk('public')->url($this->image);
    }

    public function author () {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function approuvedBy () {
        return $this->belongsTo(User::class, 'approuved_by');
    }
    public function categorie () {
        return $this->belongsTo(User::class, 'categorie_article_id');
    }
}

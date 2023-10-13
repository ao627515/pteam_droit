<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;


    protected $guarded = [''];

    public function imgInit() {

        if(!$this->IsFactory())
        {
            $this->image = $this->imageLink();
        }
    }

    private function imageLink(): string{

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

    public function IsFactory(): bool{
        return Str::startsWith($this->image, 'https');
    }

     public static function articlesAprouved(): Collection|null {
        return Article::where('approuved_at', '!=', null, 'and', 'approuved_by', '!=', null)
                        ->get();
    }

    public static function articlesDelete(): Collection|null {
        return Article::where('active', false)
                        ->get();
    }

    public static function articlesNonTraite(): Collection|null {
        return Article::where('approuved_at', null, 'and', 'approuved_by', null)
                        ->get();
    }

    public function dateFormat(string $dateTime)
    {
        $carbone = new Carbon($dateTime);

        return $carbone->format('j M Y');
    }

    public  function dateTimeFormat(string $dateTime)
    {
        $carbone = new Carbon($dateTime);

        return $carbone->format('j M Y à H\h i');
    }
}

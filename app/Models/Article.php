<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Notifications\Notifiable;
use Illuminate\Notifications\Notification;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory, Notifiable;


    protected $guarded = [''];

    public function imgInit()
    {
        if (!$this->IsFactory()) {
            $this->image = $this->imageLink();
        }
    }

    private function imageLink(): string
    {

        return Storage::url($this->image);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function approuvedBy()
    {
        return $this->belongsTo(User::class, 'approuved_by');
    }

    public function declinedBy()
    {
        return $this->belongsTo(User::class, 'declined_by');
    }

    // public function categorie()
    // {
    //     return $this->belongsTo(categorie::class, 'categorie_article_id');
    // }
    public function categories()
    {
        return $this->belongsToMany(categorie::class, 'article_categorie', 'article_id', 'categorie_id');
    }

    public function IsFactory(): bool
    {
        return Str::startsWith($this->image, 'https');
    }

    public static function articlesAprouved(int $paginate = null, int $limit = null): Collection|LengthAwarePaginator|null
    {
        return Article::where('active', true)
            ->whereNotNull('approuved_at')
            ->whereNotNull('approuved_by')
            ->when($limit, function ($query) use ($limit) {
                return $query->limit($limit);
            })
            ->when(!$paginate, function ($query) {
                return $query->get();
            })
            ->when($paginate, function ($query) use ($paginate) {
                return $query->paginate($paginate);
            });
    }

    public static function articlesDelete(): Collection|null
    {
        return Article::where('active', false)
            ->get();
    }

    public static function articlesNonTraite(): Collection|null
    {
        return Article::where('approuved_at', null, 'and', 'approuved_by', null)
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

    /**
     * Route notifications for the mail channel.
     *
     * @return  array<string, string>|string
     */
    public function routeNotificationForMail(Notification $notification): array|string
    {
        // Return email address only...
        return $this->author->email;

    }
}

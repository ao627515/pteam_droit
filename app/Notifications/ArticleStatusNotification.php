<?php

namespace App\Notifications;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ArticleStatusNotification extends Notification
{
    use Queueable;

    private bool $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Article $article,
        string $status = 'approved',
        public string $motif = '',
    ) {
        $this->status = $status === 'approved';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        if ($this->status) {
            $line = "Votre article << {$this->article->titre}>> à été appouvé.";
        } else {
            $line = "Votre article << {$this->article->titre} >> à été décliné.";
        }

        return (new MailMessage)
        ->subject('Statut article')
        ->line($line)
        ->action('Voir l\'article', route('articleAdmin.show', $this->article))
        ->line('Merci d\'utiliser notre site !');
    }
    
    public function toDatabase($notifiable)
    {
        $actionText = $this->status ? 'approuvé' : 'décliné';
        $data = [
            'type' => "Article",
            'article_id' => $this->article->id,
            'message' => "Votre article << {$this->article->titre} >> a été $actionText.",
            'object_show' => route('articleAdmin.show', $this->article->slug)
        ];

        if (!$this->status) {
            $data['motif'] = $this->motif;
        }

        return $data;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(article $notifiable): array
    {
        return [
            //
        ];
    }
}

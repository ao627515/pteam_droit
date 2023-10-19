<?php

namespace App\Notifications;

use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Termwind\Components\Li;

class MonitoringStatusNotification extends Notification
{
    use Queueable;

    private bool $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        string $status = 'approuved',
        public string $motif = ''
    ) {
        $this->status = $status == 'approuved' ? true : false;
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
            $line = "Votre article << $notifiable->titre >> à été appouvé.";
        } else {
            $line = "Votre article << $notifiable->titre >> à été décliné.";
        }

        return (new MailMessage)
            ->subject('Statut article')
            ->line($line)
            ->action('Voir l\'article', route('articleAdmin.show', $notifiable))
            ->line('Merci d\'utiliser notre site !');
    }


    public function toDatabase($notifiable)
    {
        if ($this->status) {
            return [
                'article_id' => $notifiable->id,
                'message' => "Votre article a été approuvé \n Voir l'article " . route('articleAdmin.show', $notifiable),
                'approuved_by' => $notifiable->approuved_by,
            ];
        } else {
            return [
                'article_id' => $notifiable->id,
                'declined_by' => $notifiable->declined_by,
                'motif' => $this->motif,
                'message' => "Votre article a été décliné \n Voir l'article " . route('articleAdmin.show', $notifiable),
            ];
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

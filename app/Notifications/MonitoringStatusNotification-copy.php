<?php

namespace App\Notifications;

use App\Models\Article;
use App\Models\Produit;
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
        public Article|Produit $object,
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
        if ($this->object instanceof Article) {
            if ($this->status) {
                $line = "Votre article << {$this->object->titre}>> à été appouvé.";
            } else {
                $line = "Votre article << {$this->object->titre} >> à été décliné.";
            }

            return (new MailMessage)
                ->subject('Statut article')
                ->line($line)
                ->action('Voir l\'article', route('articleAdmin.show', $this->object))
                ->line('Merci d\'utiliser notre site !');
        } elseif ($this->object instanceof Produit) {
            if ($this->status) {
                $line = "Votre produit << {$this->object->nom} >> à été appouvé.";
            } else {
                $line = "Votre produit << {$this->object->nom}>> à été décliné.";
            }

            return (new MailMessage)
                ->subject('Statut produit')
                ->line($line)
                ->action('Voir produit', route('produitAdmin.show', $this->object))
                ->line('Merci d\'utiliser notre site !');
        }
    }


    public function toDatabase($notifiable)
    {
        if ($this->object instanceof Article) {

            if ($this->status) {
                return [
                    'type' => "Article",
                    'message' => "Votre article << {$this->object->titre}>> à été appouvé.",
                    'approuved_by' => $this->object->approuved_by,
                ];
            } else {
                return [
                    'object_id' => $this->object->id,
                    'motif' => $this->motif,
                    'message' => "Votre article << {$this->object->titre}>> à été appouvé.",
                ];
            }
        } elseif ($this->object instanceof Produit) {
            if ($this->status) {
                return [
                    'type' => "Produit",
                    'object_id' => $this->object->id,
                    'message' => "Votre produit << {$this->object->nom} >> à été appouvé.",
                ];
            } else {
                return [
                    'type' => 'Produit',
                    'object_id' => $this->object->id,
                    'motif' => $this->motif,
                    'message' => "Votre produit << {$this->object->nom} >> à été decliné.",
                ];
            }
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

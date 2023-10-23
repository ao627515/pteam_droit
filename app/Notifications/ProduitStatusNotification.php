<?php

namespace App\Notifications;

use App\Models\Produit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProduitStatusNotification extends Notification
{
    use Queueable;

    private bool $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Produit $produit,
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
            $line = "Votre produit << {$this->produit->titre}>> à été appouvé.";
        } else {
            $line = "Votre produit << {$this->produit->titre} >> à été décliné.";
        }

        return (new MailMessage)
        ->subject('Statut produit')
        ->line($line)
        ->action('Voir l\'produit', route('produitAdmin.show', $this->produit))
        ->line('Merci d\'utiliser notre site !');
    }

    public function toDatabase($notifiable)
    {
        $actionText = $this->status ? 'approuvé' : 'décliné';
        $data = [
            'type' => "Produit",
            'produit_id' => $this->produit->id,
            'message' => "Votre produit << {$this->produit->nom} >> a été $actionText.",
            'object_show' => route('produitAdmin.show', $this->produit)
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
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}

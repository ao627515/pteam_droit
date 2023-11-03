<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PartnershipRequestNotification extends Notification
{
    use Queueable;

    private bool $status;

    /**
     * Create a new notification instance.
     */
    public function __construct(
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
            $line = "Votre demande d'inscription a été à été appouvé.";
            return (new MailMessage)
                ->subject('Statut partenaire')
                ->line($line)
                ->line('Merci d\'utiliser notre site !');
        } else {
            $line = "Votre d'inscription à été décliné pour les raisons suivante : ";
            return (new MailMessage)
            ->subject('Statut partenaire')
            ->line($line)
            ->line($this->motif)
            ->action('Voir votre page', route('partenaireAdmin.show', $notifiable))
            ->line('Merci d\'utiliser notre site !');
        }
    }

    public function toDatabase(object $notifiable)
    {
        $actionText = $this->status ? 'approuvé' : 'décliné';
        $data = [
            'type' => "Inscription Partenaire",
            'partenaire_id' => $notifiable->id,
            'message' => "Votre demande d'inscription à été $actionText.",
            'object_show' => route('partenaireAdmin.show', $notifiable)
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

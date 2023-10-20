<?php

namespace App\Notifications;

use App\Models\Article;
use App\Models\Produit;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
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
        $objectType = $this->object instanceof Article ? 'article' : 'produit';
        $objectName = $this->object instanceof Article ? $this->object->titre : $this->object->nom;
        $actionText = $this->status ? 'approuvé' : 'décliné';

        $line = "Votre $objectType << $objectName >> a été $actionText.";

        $routeName = $this->object instanceof Article ? 'articleAdmin.show' : 'produitAdmin.show';

        return (new MailMessage)
            ->subject("Statut $objectType")
            ->line($line)
            ->action("Voir l'$objectType", route($routeName, $this->object))
            ->line('Merci d\'utiliser notre site !');
    }

    public function toDatabase($notifiable)
    {
        $objectType = $this->object instanceof Article ? 'Article' : 'Produit';
        $objectRouteName = $this->object instanceof Article ? 'articleAdmin' : 'produitAdmin';
        $object = $this->object->titre ?? $this->object->nom;
        $actionText = $this->status ? 'approuvé' : 'décliné';

        $data = [
            'type' => $objectType,
            'message' => "Votre $objectType << {$object} >> a été $actionText.",
            'object_show' => route($objectRouteName.'.show', $this->object)
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


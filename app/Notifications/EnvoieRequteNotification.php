<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EnvoieRequteNotification extends Notification
{
    use Queueable;

    protected $nom;
    protected $prenom;

    protected $objet;
    /**
     * Create a new notification instance.
     */
    public function __construct( $nom, $prenom, $objet )
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->objet = $objet;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
        ->subject('Votre ticket a ete reçue !')
        ->view('includes.sendrequete', 
        [
            'lien' => 'http://127.0.0.1:8000/home',
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'objet' => $this->objet,
        ]
        );   
               
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

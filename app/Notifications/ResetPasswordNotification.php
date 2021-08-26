<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    public $token;
    public $email;
    public $name;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {   
        $url = route("pesquisa") . '/password/reset/'.$this->token.'?email='.$this->email;
        $min = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        return (new MailMessage)
            ->greeting('Olá '. $this->name)
            ->subject('Recuperação de senha.')
            ->line('Você recebendo este e-mail por ter solicitado uma recuperação de senha para sua conta!')
            ->action('Restaurar senha', $url)
            ->line('O link para recuperação de senha irá expirar em ' . $min . ' minutos')
            ->line('Caso você não tenha requisitado a recuperação da senha, desconsidere este e-mail.')
            ->salutation('Atenciosamente, Equipe Licenciamento Caucaia');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

<?php

namespace App\Notifications;

use App\Models\AppointmentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewMessageNotification extends Notification
{
    use Queueable;

    public function __construct(
        public AppointmentRequest $appointment,
        public string $senderName
    ) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $isFamily = $notifiable->id === $this->appointment->family_user_id;
        $path     = $isFamily
            ? '/family/messages/' . $this->appointment->id
            : '/provider/messages/' . $this->appointment->id;

        return (new MailMessage)
            ->subject('New Message from ' . $this->senderName . ' — Kids Health Hub')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line($this->senderName . ' sent you a message regarding the appointment request with ' . $this->appointment->provider->business_name . '.')
            ->action('Read Message', url($path))
            ->line('Log in to reply. You will only receive one notification per thread per day.');
    }
}

<?php

namespace App\Notifications;

use App\Models\AppointmentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentRequestedNotification extends Notification
{
    use Queueable;

    public function __construct(public AppointmentRequest $appointment) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('New Appointment Request — ' . $this->appointment->family->name)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('You have received a new appointment request.')
            ->line('**From:** ' . $this->appointment->family->name)
            ->line('**Preferred date:** ' . $this->appointment->preferred_date->format('l, d F Y'))
            ->when($this->appointment->notes, fn ($m) => $m->line('**Notes:** ' . $this->appointment->notes))
            ->action('View Request', url('/provider/dashboard'))
            ->line('Please log in to your dashboard to accept or decline this request.');
    }
}

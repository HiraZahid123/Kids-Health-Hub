<?php

namespace App\Notifications;

use App\Models\AppointmentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AppointmentRespondedNotification extends Notification
{
    use Queueable;

    public function __construct(public AppointmentRequest $appointment) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $accepted = $this->appointment->isAccepted();
        $provider = $this->appointment->provider;

        $mail = (new MailMessage)
            ->subject(($accepted ? 'Appointment Accepted' : 'Appointment Declined') . ' — ' . $provider->business_name)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line($accepted
                ? $provider->business_name . ' has **accepted** your appointment request.'
                : $provider->business_name . ' has **declined** your appointment request.'
            )
            ->line('**Requested date:** ' . $this->appointment->preferred_date->format('l, d F Y'));

        if ($this->appointment->provider_message) {
            $mail->line('**Message from provider:** ' . $this->appointment->provider_message);
        }

        if ($accepted && $provider->phone) {
            $mail->line('You can contact the provider directly at: ' . $provider->phone);
        }

        return $mail
            ->action('View My Appointments', url('/family/appointments'))
            ->line('Thank you for using Kids Health Hub.');
    }
}

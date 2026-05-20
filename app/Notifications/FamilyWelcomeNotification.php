<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FamilyWelcomeNotification extends Notification
{
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Welcome to Kids Health Hub!')
            ->greeting("Hi {$notifiable->name},")
            ->line('Your family account is ready. You can now search for child healthcare providers, save your favourites, and request appointments.')
            ->action('Find Providers Near You', route('providers.index'))
            ->line('We\'re glad to have you on Kids Health Hub.')
            ->salutation('The Kids Health Hub Team');
    }
}

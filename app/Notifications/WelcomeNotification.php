<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class WelcomeNotification extends Notification
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
            ->line('Thank you for registering on Kids Health Hub. Your provider profile has been created and is now pending review by our admin team.')
            ->line('Once approved, your listing will appear on our map and search results so families can find you.')
            ->action('Go to Your Dashboard', route('provider.dashboard'))
            ->line('If you have any questions, feel free to reach out to our support team.')
            ->salutation('The Kids Health Hub Team');
    }
}

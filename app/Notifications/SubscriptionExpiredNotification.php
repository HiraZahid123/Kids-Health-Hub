<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SubscriptionExpiredNotification extends Notification
{
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your Kids Health Hub listing is now hidden')
            ->greeting("Hi {$notifiable->name},")
            ->line('Your subscription has expired and your listing has been hidden from families on Kids Health Hub.')
            ->line('To get your listing live again, please contact us to renew your subscription.')
            ->action('Go to Your Dashboard', route('provider.dashboard'))
            ->salutation('The Kids Health Hub Team');
    }
}

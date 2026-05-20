<?php

namespace App\Notifications;

use App\Models\Provider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProviderApprovedNotification extends Notification
{
    public function __construct(public Provider $provider) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Your listing has been approved — Kids Health Hub')
            ->greeting("Great news, {$notifiable->name}!")
            ->line("Your listing **{$this->provider->business_name}** has been reviewed and approved.")
            ->line('You are now live on Kids Health Hub. Families can find your profile on the map and in search results.')
            ->action('View Your Public Profile', route('providers.show', $this->provider->slug))
            ->line('Make sure your profile is complete and your availability is up to date to get the most visibility.')
            ->salutation('The Kids Health Hub Team');
    }
}

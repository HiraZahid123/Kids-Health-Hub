<?php

namespace App\Notifications;

use App\Models\Provider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProviderRejectedNotification extends Notification
{
    public function __construct(public Provider $provider) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $message = (new MailMessage)
            ->subject('Update on your Kids Health Hub application')
            ->greeting("Hi {$notifiable->name},")
            ->line("We have reviewed your listing **{$this->provider->business_name}** and unfortunately it did not meet our requirements at this time.");

        if ($this->provider->admin_notes) {
            $message->line('**Reason provided:**')
                    ->line($this->provider->admin_notes);
        }

        return $message
            ->line('You are welcome to update your profile and resubmit for review.')
            ->action('Update Your Profile', route('provider.profile.edit'))
            ->line('If you believe this decision was made in error, please contact our support team.')
            ->salutation('The Kids Health Hub Team');
    }
}

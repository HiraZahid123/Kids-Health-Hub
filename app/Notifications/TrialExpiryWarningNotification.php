<?php

namespace App\Notifications;

use App\Models\Subscription;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TrialExpiryWarningNotification extends Notification
{
    public function __construct(public Subscription $subscription) {}

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $expiryDate = $this->subscription->trial_ends_at->format('d M Y');

        return (new MailMessage)
            ->subject('Your free trial expires in 7 days — Kids Health Hub')
            ->greeting("Hi {$notifiable->name},")
            ->line("This is a reminder that your free trial on Kids Health Hub expires on **{$expiryDate}**.")
            ->line('After your trial ends, your listing will be hidden from families until your subscription is renewed.')
            ->action('Go to Your Dashboard', route('provider.dashboard'))
            ->line('Please contact us to arrange a subscription and keep your listing visible.')
            ->salutation('The Kids Health Hub Team');
    }
}

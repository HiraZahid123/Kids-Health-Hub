<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use App\Notifications\SubscriptionExpiredNotification;
use App\Notifications\TrialExpiryWarningNotification;
use Illuminate\Console\Command;

class ExpireSubscriptions extends Command
{
    protected $signature   = 'subscriptions:expire';
    protected $description = 'Mark expired subscriptions, hide inactive providers, and send expiry warning emails';

    public function handle(): int
    {
        $this->sendTrialWarnings();
        $this->expireTrials();
        $this->expireActive();

        return self::SUCCESS;
    }

    private function sendTrialWarnings(): void
    {
        $subs = Subscription::where('status', 'trial')
            ->where('trial_warning_sent', false)
            ->whereBetween('trial_ends_at', [now(), now()->addDays(7)])
            ->with('provider.user')
            ->get();

        foreach ($subs as $sub) {
            optional($sub->provider?->user)->notify(new TrialExpiryWarningNotification($sub));
            $sub->update(['trial_warning_sent' => true]);
        }

        if ($subs->isNotEmpty()) {
            $this->info("Sent {$subs->count()} trial expiry warning(s).");
        }
    }

    private function expireTrials(): void
    {
        $subs = Subscription::where('status', 'trial')
            ->where('trial_ends_at', '<', now())
            ->with('provider.user')
            ->get();

        foreach ($subs as $sub) {
            $sub->update(['status' => 'expired']);
            $sub->provider()->update(['is_active' => false]);
            optional($sub->provider?->user)->notify(new SubscriptionExpiredNotification());
        }

        if ($subs->isNotEmpty()) {
            $this->info("Expired {$subs->count()} trial(s).");
        }
    }

    private function expireActive(): void
    {
        $subs = Subscription::where('status', 'active')
            ->where('ends_at', '<', now())
            ->with('provider.user')
            ->get();

        foreach ($subs as $sub) {
            $sub->update(['status' => 'expired']);
            $sub->provider()->update(['is_active' => false]);
            optional($sub->provider?->user)->notify(new SubscriptionExpiredNotification());
        }

        if ($subs->isNotEmpty()) {
            $this->info("Expired {$subs->count()} active subscription(s).");
        }
    }
}

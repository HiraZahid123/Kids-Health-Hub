<?php

namespace App\Console\Commands;

use App\Models\Subscription;
use Illuminate\Console\Command;

class ExpireSubscriptions extends Command
{
    protected $signature   = 'subscriptions:expire';
    protected $description = 'Mark expired subscriptions and hide inactive providers';

    public function handle(): int
    {
        $expiredTrials = Subscription::where('status', 'trial')
            ->where('trial_ends_at', '<', now())
            ->get();

        foreach ($expiredTrials as $sub) {
            $sub->update(['status' => 'expired']);
            $sub->provider()->update(['is_active' => false]);
        }

        $expiredActive = Subscription::where('status', 'active')
            ->where('ends_at', '<', now())
            ->get();

        foreach ($expiredActive as $sub) {
            $sub->update(['status' => 'expired']);
            $sub->provider()->update(['is_active' => false]);
        }

        $total = $expiredTrials->count() + $expiredActive->count();
        $this->info("Expired {$total} subscription(s).");

        return self::SUCCESS;
    }
}

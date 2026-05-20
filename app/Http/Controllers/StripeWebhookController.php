<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request): Response
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $payload       = $request->getContent();
        $sigHeader     = $request->header('Stripe-Signature');
        $webhookSecret = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $webhookSecret);
        } catch (\Exception $e) {
            Log::warning('Stripe webhook signature verification failed', ['error' => $e->getMessage()]);
            return response('Invalid signature', 400);
        }

        match ($event->type) {
            'checkout.session.completed'    => $this->handleCheckoutCompleted($event->data->object),
            'invoice.payment_succeeded'     => $this->handleInvoicePaid($event->data->object),
            'customer.subscription.deleted' => $this->handleSubscriptionDeleted($event->data->object),
            default                         => null,
        };

        return response('OK', 200);
    }

    private function handleCheckoutCompleted(object $session): void
    {
        if ($session->mode !== 'subscription' || $session->payment_status !== 'paid') {
            return;
        }

        $providerId = $session->metadata->provider_id ?? null;
        if (! $providerId) return;

        $sub = Subscription::where('provider_id', $providerId)
            ->whereIn('status', ['trial', 'expired'])
            ->latest()
            ->first();

        if (! $sub) return;

        $plan   = $session->metadata->plan ?? 'monthly';
        $endsAt = $plan === 'annual' ? now()->addYear() : now()->addMonth();

        $sub->update([
            'status'                 => 'active',
            'plan_type'              => $plan,
            'payment_status'         => 'paid',
            'stripe_customer_id'     => $session->customer,
            'stripe_subscription_id' => $session->subscription,
            'starts_at'              => now(),
            'ends_at'                => $endsAt,
        ]);

        $sub->provider()->update(['is_active' => true]);
    }

    private function handleInvoicePaid(object $invoice): void
    {
        if (empty($invoice->subscription)) return;

        $sub = Subscription::where('stripe_subscription_id', $invoice->subscription)->first();
        if (! $sub) return;

        $sub->update([
            'status'         => 'active',
            'payment_status' => 'paid',
            'ends_at'        => \Carbon\Carbon::createFromTimestamp($invoice->lines->data[0]->period->end ?? now()->addMonth()->timestamp),
        ]);

        $sub->provider()->update(['is_active' => true]);
    }

    private function handleSubscriptionDeleted(object $stripeSub): void
    {
        $sub = Subscription::where('stripe_subscription_id', $stripeSub->id)->first();
        if (! $sub) return;

        $sub->update(['status' => 'expired', 'payment_status' => 'cancelled']);
        $sub->provider()->update(['is_active' => false]);
    }
}

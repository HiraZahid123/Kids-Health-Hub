<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

class StripeCheckoutController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'plan' => ['required', 'in:monthly,annual'],
        ]);

        $provider = auth()->user()->provider;

        $priceId = $validated['plan'] === 'annual'
            ? config('services.stripe.annual_price_id')
            : config('services.stripe.monthly_price_id');

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::create([
            'mode'                 => 'subscription',
            'payment_method_types' => ['card'],
            'customer_email'       => auth()->user()->email,
            'line_items'           => [['price' => $priceId, 'quantity' => 1]],
            'success_url'          => route('provider.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'           => route('provider.dashboard'),
            'metadata'             => [
                'provider_id' => $provider->id,
                'plan'        => $validated['plan'],
            ],
        ]);

        return redirect($session->url);
    }

    public function success(Request $request): View|RedirectResponse
    {
        $sessionId = $request->query('session_id');

        if (! $sessionId) {
            return redirect()->route('provider.dashboard');
        }

        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::retrieve([
            'id'     => $sessionId,
            'expand' => ['subscription'],
        ]);

        if ($session->payment_status === 'paid') {
            $provider = auth()->user()->provider;
            $plan     = $session->metadata->plan ?? 'monthly';

            $endsAt = $plan === 'annual' ? now()->addYear() : now()->addMonth();

            $provider->subscription->update([
                'status'                 => 'active',
                'plan_type'              => $plan,
                'payment_status'         => 'paid',
                'stripe_customer_id'     => $session->customer,
                'stripe_subscription_id' => $session->subscription->id ?? null,
                'starts_at'              => now(),
                'ends_at'                => $endsAt,
            ]);

            $provider->update(['is_active' => true]);
        }

        return view('provider.checkout-success');
    }
}

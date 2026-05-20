<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use App\Notifications\AppointmentRespondedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProviderAppointmentController extends Controller
{
    public function index(): View
    {
        $provider = auth()->user()->provider;

        abort_if(! $provider, 403);

        $pending  = AppointmentRequest::with('family')
            ->where('provider_id', $provider->id)
            ->where('status', 'pending')
            ->orderBy('preferred_date')
            ->get();

        $responded = AppointmentRequest::with('family')
            ->where('provider_id', $provider->id)
            ->whereIn('status', ['accepted', 'declined'])
            ->latest()
            ->limit(50)
            ->get();

        return view('provider.appointments', compact('pending', 'responded'));
    }

    public function respond(Request $request, AppointmentRequest $appointment): RedirectResponse
    {
        $provider = auth()->user()->provider;
        abort_if(! $provider || $appointment->provider_id !== $provider->id, 403);
        abort_if(! $appointment->isPending(), 422);

        $request->validate([
            'action'           => ['required', 'in:accepted,declined'],
            'provider_message' => ['nullable', 'string', 'max:500'],
        ]);

        $appointment->update([
            'status'           => $request->action,
            'provider_message' => $request->provider_message,
        ]);

        // Notify family
        $appointment->family->notify(new AppointmentRespondedNotification($appointment));

        $label = $request->action === 'accepted' ? 'accepted' : 'declined';
        return back()->with('success', "Appointment request {$label}.");
    }
}

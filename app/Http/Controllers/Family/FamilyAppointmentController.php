<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use App\Models\Provider;
use App\Notifications\AppointmentRequestedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FamilyAppointmentController extends Controller
{
    public function index(): View
    {
        $appointments = auth()->user()
            ->appointmentRequests()
            ->with('provider.categories')
            ->latest()
            ->get();

        return view('family.appointments', compact('appointments'));
    }

    public function store(Request $request, Provider $provider): RedirectResponse
    {
        $request->validate([
            'preferred_date' => ['required', 'date', 'after_or_equal:today'],
            'notes'          => ['nullable', 'string', 'max:500'],
        ]);

        $user = auth()->user();

        $existing = AppointmentRequest::where('family_user_id', $user->id)
            ->where('provider_id', $provider->id)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return back()->with('error', 'You already have a pending appointment request with this provider.');
        }

        $appointment = AppointmentRequest::create([
            'family_user_id' => $user->id,
            'provider_id'    => $provider->id,
            'preferred_date' => $request->preferred_date,
            'notes'          => $request->notes,
            'status'         => 'pending',
        ]);

        // Notify provider
        $provider->user->notify(new AppointmentRequestedNotification($appointment));

        return back()->with('success', 'Your appointment request has been sent to ' . $provider->business_name . '.');
    }
}

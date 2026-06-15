<?php

namespace App\Http\Controllers;

use App\Models\AppointmentRequest;
use App\Models\Message;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessageController extends Controller
{
    public function index(): View
    {
        $user     = auth()->user();
        $provider = $user->provider;
        abort_if(! $provider, 403);

        $threads = AppointmentRequest::with(['family', 'messages' => fn ($q) => $q->latest()->limit(1)])
            ->withCount(['messages as unread_count' => fn ($q) => $q->whereNull('read_at')->where('sender_id', '!=', $user->id)])
            ->where('provider_id', $provider->id)
            ->whereHas('messages')
            ->latest('updated_at')
            ->get();

        return view('provider.messages', compact('threads'));
    }

    public function show(AppointmentRequest $appointment): View
    {
        $user = auth()->user();
        $this->authorizeAccess($user, $appointment);

        $messages = $appointment->messages()->with('sender')->oldest()->get();

        // Mark all unread messages sent by the other party as read
        $appointment->messages()
            ->whereNull('read_at')
            ->where('sender_id', '!=', $user->id)
            ->update(['read_at' => now()]);

        return view('messages.thread', compact('appointment', 'messages'));
    }

    public function store(Request $request, AppointmentRequest $appointment): RedirectResponse
    {
        $user = auth()->user();
        $this->authorizeAccess($user, $appointment);

        $request->validate([
            'body' => ['required', 'string', 'max:2000'],
        ]);

        Message::create([
            'appointment_request_id' => $appointment->id,
            'sender_id'              => $user->id,
            'body'                   => $request->body,
        ]);

        $this->maybeNotifyRecipient($user, $appointment);

        return back()->with('success', 'Message sent.');
    }

    private function authorizeAccess($user, AppointmentRequest $appointment): void
    {
        $isProvider = $user->isProvider() && $appointment->provider->user_id === $user->id;
        abort_if(! $isProvider, 403);
    }

    private function maybeNotifyRecipient($sender, AppointmentRequest $appointment): void
    {
        // Provider sent — notify family user
        $lastNotified = $appointment->family_last_notified_at;
        if (! $lastNotified || $lastNotified->lt(now()->subDay())) {
            $appointment->family->notify(
                new NewMessageNotification($appointment, $sender->name)
            );
            $appointment->update(['family_last_notified_at' => now()]);
        }
    }
}

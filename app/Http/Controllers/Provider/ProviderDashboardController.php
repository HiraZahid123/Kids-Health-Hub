<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use App\Models\Message;
use App\Models\ProviderView;
use Illuminate\View\View;

class ProviderDashboardController extends Controller
{
    public function index(): View
    {
        $user     = auth()->user();
        $provider = $user->provider()->with(['subscription', 'categories'])->first();

        $viewStats = null;

        $pendingAppointmentCount = 0;
        $unreadMessageCount      = 0;

        if ($provider) {
            $base = ProviderView::where('provider_id', $provider->id);

            $viewStats = [
                'this_week'  => (clone $base)->where('viewed_at', '>=', now()->startOfWeek())->count(),
                'this_month' => (clone $base)->where('viewed_at', '>=', now()->startOfMonth())->count(),
                'all_time'   => (clone $base)->count(),
            ];

            $pendingAppointmentCount = AppointmentRequest::where('provider_id', $provider->id)
                ->where('status', 'pending')
                ->count();

            $unreadMessageCount = Message::whereHas('appointment', fn ($q) => $q->where('provider_id', $provider->id))
                ->whereNull('read_at')
                ->where('sender_id', '!=', $user->id)
                ->count();
        }

        return view('provider.dashboard', compact('provider', 'viewStats', 'pendingAppointmentCount', 'unreadMessageCount'));
    }
}

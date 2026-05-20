<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\AppointmentRequest;
use App\Models\Message;
use Illuminate\View\View;

class FamilyDashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        $savedCount       = $user->savedProviders()->count();
        $appointmentCount = AppointmentRequest::where('family_user_id', $user->id)->count();
        $unreadMessageCount = Message::whereHas('appointment', fn ($q) => $q->where('family_user_id', $user->id))
            ->whereNull('read_at')
            ->where('sender_id', '!=', $user->id)
            ->count();

        return view('family.dashboard', compact('user', 'savedCount', 'appointmentCount', 'unreadMessageCount'));
    }
}

<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ProviderDashboardController extends Controller
{
    public function index(): View
    {
        $user     = auth()->user();
        $provider = $user->provider()->with(['subscription', 'categories'])->first();

        return view('provider.dashboard', compact('provider'));
    }
}

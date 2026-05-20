<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\PlatformSetting;
use App\Models\Provider;
use App\Models\Subscription;
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            'business_name' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('provider');

        $slug = $this->generateUniqueSlug($request->business_name);

        $provider = Provider::create([
            'user_id'       => $user->id,
            'business_name' => $request->business_name,
            'provider_name' => $request->name,
            'slug'          => $slug,
        ]);

        $trialMonths = (int) PlatformSetting::get('trial_duration_months', 3);

        Subscription::create([
            'provider_id'   => $provider->id,
            'plan_type'     => 'solo',
            'status'        => 'trial',
            'trial_ends_at' => now()->addMonths($trialMonths),
        ]);

        event(new Registered($user));

        $user->notify(new WelcomeNotification());

        Auth::login($user);

        return redirect()->route('provider.dashboard');
    }

    private function generateUniqueSlug(string $businessName): string
    {
        $base = Str::slug($businessName);
        $slug = $base;
        $i    = 1;

        while (Provider::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}

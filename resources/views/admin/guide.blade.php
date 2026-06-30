@extends('layouts.dashboard')

@section('title', 'Admin Guide')
@section('page-title', 'Admin Guide')

@section('content')

{{-- Page header --}}
<div class="mb-8">
    <div class="flex items-center gap-3 mb-2">
        <div class="w-10 h-10 rounded-2xl flex items-center justify-center bg-violet-100">
            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
        </div>
        <div>
            <h1 class="text-2xl font-black text-gray-900">Admin Guide</h1>
            <p class="text-sm text-gray-500">Everything you need to know to manage Kids Health Hub</p>
        </div>
    </div>
    <div class="rounded-2xl p-4 flex items-start gap-3 mt-4" style="background:#f5f3ff; border:1px solid #e0d9ff;">
        <svg class="w-5 h-5 flex-shrink-0 mt-0.5 text-violet-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-sm text-violet-800 leading-relaxed">This guide explains every section of your admin panel in plain language. You can always come back here if you're unsure what something does. Use the links below to jump straight to any topic.</p>
    </div>
</div>

{{-- Quick jump links --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 mb-8">
    <h2 class="text-sm font-black text-gray-500 uppercase tracking-wider mb-4">Jump to a section</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
        @foreach([
            ['href'=>'#overview',       'icon'=>'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z', 'label'=>'Overview', 'color'=>'violet'],
            ['href'=>'#providers',      'icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z', 'label'=>'Providers', 'color'=>'emerald'],
            ['href'=>'#approving',      'icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z', 'label'=>'Approving', 'color'=>'green'],
            ['href'=>'#featured',       'icon'=>'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z', 'label'=>'Featured', 'color'=>'amber'],
            ['href'=>'#subscriptions',  'icon'=>'M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z', 'label'=>'Subscriptions', 'color'=>'blue'],
            ['href'=>'#reviews',        'icon'=>'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z', 'label'=>'Reviews', 'color'=>'yellow'],
            ['href'=>'#blog',           'icon'=>'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z', 'label'=>'Blog', 'color'=>'rose'],
            ['href'=>'#settings',       'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z', 'label'=>'Settings', 'color'=>'gray'],
            ['href'=>'#pricing-settings','icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z', 'label'=>'Pricing', 'color'=>'orange'],
        ] as $link)
        <a href="{{ $link['href'] }}" class="flex items-center gap-2.5 rounded-xl px-4 py-3 text-sm font-bold transition-colors bg-{{ $link['color'] }}-50 text-{{ $link['color'] }}-700 hover:bg-{{ $link['color'] }}-100">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $link['icon'] }}"/></svg>
            {{ $link['label'] }}
        </a>
        @endforeach
    </div>
</div>

{{-- ═══════ 1. OVERVIEW ═══════ --}}
<div id="overview" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 mb-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-violet-100">
            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
        </div>
        <h2 class="text-xl font-black text-gray-900">1. The Dashboard Overview</h2>
    </div>
    <p class="text-gray-600 leading-relaxed mb-4">When you first log in, you land on your <strong>Admin Dashboard</strong>. Think of this as your control room - it gives you a quick snapshot of what's happening on the platform at a glance.</p>
    <div class="grid sm:grid-cols-2 gap-4 mb-5">
        @foreach([
            ['color'=>'amber','title'=>'Pending Approval','desc'=>'The number of new provider accounts waiting for you to review and approve. This is the number you want to check first each day - providers cannot be seen by families until you approve them.'],
            ['color'=>'emerald','title'=>'Approved Providers','desc'=>'How many providers are currently live and visible on the website. These are the ones families can find when they search.'],
            ['color'=>'blue','title'=>'On Trial','desc'=>'Providers who have registered but are on their free 3-month trial period. They are fully visible to families during this time.'],
            ['color'=>'violet','title'=>'Featured','desc'=>'The number of providers you have manually highlighted. Featured providers appear at the top of search results and on the homepage.'],
        ] as $stat)
        <div class="rounded-xl p-4" style="background:#f9f9ff; border:1px solid #eee;">
            <p class="font-black text-gray-800 text-sm mb-1">{{ $stat['title'] }}</p>
            <p class="text-gray-500 text-sm leading-relaxed">{{ $stat['desc'] }}</p>
        </div>
        @endforeach
    </div>
    <div class="rounded-xl p-4 flex gap-3" style="background:#fffbeb; border:1px solid #fde68a;">
        <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        <p class="text-sm text-amber-800 leading-relaxed"><strong>Tip:</strong> Check the dashboard daily. If the "Pending Approval" number is above 0, new providers are waiting. They receive an email automatically once you approve them.</p>
    </div>
</div>

{{-- ═══════ 2. PROVIDERS ═══════ --}}
<div id="providers" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 mb-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-emerald-100">
            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
        </div>
        <h2 class="text-xl font-black text-gray-900">2. Managing Providers</h2>
    </div>
    <p class="text-gray-600 leading-relaxed mb-5">The <strong>Providers</strong> section is where you manage all the healthcare practitioners on the platform. You can find it in the left sidebar. Here you can see every provider who has ever signed up - pending, approved, or rejected.</p>

    <h3 class="font-black text-gray-800 mb-3">What you'll see on the Providers page</h3>
    <div class="space-y-3 mb-6">
        @foreach([
            ['badge'=>'Pending','color'=>'amber','desc'=>'A yellow badge means this provider has just signed up and is waiting for your review. They are NOT visible to families yet.'],
            ['badge'=>'Approved','color'=>'emerald','desc'=>'A green badge means this provider is live on the website and families can find them in search results.'],
            ['badge'=>'Rejected','color'=>'red','desc'=>'A red badge means you have declined this provider. Their listing is hidden from the public site.'],
        ] as $item)
        <div class="flex items-start gap-3 rounded-xl p-3.5" style="background:#f9fafb; border:1px solid #f0f0f0;">
            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-black text-{{ $item['color'] }}-700 bg-{{ $item['color'] }}-100 flex-shrink-0 mt-0.5">{{ $item['badge'] }}</span>
            <p class="text-sm text-gray-600 leading-relaxed">{{ $item['desc'] }}</p>
        </div>
        @endforeach
    </div>

    <h3 class="font-black text-gray-800 mb-3">Viewing a provider's full details</h3>
    <p class="text-gray-600 text-sm leading-relaxed mb-4">Click the <strong>"View"</strong> button next to any provider to open their full profile. You will see everything they have filled in - their business name, bio, categories, contact details, suburb, and subscription status. Review this information carefully before approving.</p>

    <div class="rounded-xl p-4 flex gap-3" style="background:#f0fdf4; border:1px solid #bbf7d0;">
        <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-sm text-emerald-800 leading-relaxed">You can also use the filter buttons at the top of the providers list to show only "Pending", "Approved", or "Rejected" providers - this makes it much easier to find who needs attention.</p>
    </div>
</div>

{{-- ═══════ 3. APPROVING ═══════ --}}
<div id="approving" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 mb-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-green-100">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h2 class="text-xl font-black text-gray-900">3. Approving and Rejecting Providers</h2>
    </div>
    <p class="text-gray-600 leading-relaxed mb-5">This is one of the most important things you do as admin. Every new healthcare provider who registers must be approved by you before families can see them. This keeps the directory trustworthy.</p>

    <h3 class="font-black text-gray-800 mb-4">How to approve a provider - step by step</h3>
    <div class="space-y-3 mb-6">
        @foreach([
            ['num'=>'1','title'=>'Go to Providers','desc'=>'Click "Providers" in the left sidebar menu.'],
            ['num'=>'2','title'=>'Find pending providers','desc'=>'Look for providers with a yellow "Pending" badge, or use the filter to show only pending providers.'],
            ['num'=>'3','title'=>'Click View','desc'=>'Click the "View" button next to the provider you want to review. Read through their profile carefully.'],
            ['num'=>'4','title'=>'Make your decision','desc'=>'At the top of their profile page, you will see three buttons: Approve (green), Reject (red), and Suspend (grey). Click the appropriate one.'],
            ['num'=>'5','title'=>'Provider gets notified','desc'=>'The provider automatically receives an email telling them whether they have been approved or rejected. You do not need to email them separately.'],
        ] as $step)
        <div class="flex items-start gap-4 rounded-xl p-4" style="background:#f9fafb; border:1px solid #f0f0f0;">
            <span class="flex h-8 w-8 flex-shrink-0 items-center justify-center rounded-full text-sm font-black text-white" style="background:#6d28d9;">{{ $step['num'] }}</span>
            <div>
                <p class="font-black text-gray-800 text-sm">{{ $step['title'] }}</p>
                <p class="text-gray-500 text-sm mt-0.5 leading-relaxed">{{ $step['desc'] }}</p>
            </div>
        </div>
        @endforeach
    </div>

    <h3 class="font-black text-gray-800 mb-3">What each button does</h3>
    <div class="grid sm:grid-cols-3 gap-3 mb-5">
        <div class="rounded-xl p-4 text-center" style="background:#f0fdf4; border:1px solid #bbf7d0;">
            <p class="font-black text-green-700 text-sm mb-1">Approve</p>
            <p class="text-xs text-gray-500 leading-relaxed">The provider goes live immediately. Families can now find them in search results.</p>
        </div>
        <div class="rounded-xl p-4 text-center" style="background:#fef2f2; border:1px solid #fecaca;">
            <p class="font-black text-red-700 text-sm mb-1">Reject</p>
            <p class="text-xs text-gray-500 leading-relaxed">The provider is declined. Their profile stays hidden. They receive an email letting them know.</p>
        </div>
        <div class="rounded-xl p-4 text-center" style="background:#f9fafb; border:1px solid #e5e7eb;">
            <p class="font-black text-gray-700 text-sm mb-1">Suspend</p>
            <p class="text-xs text-gray-500 leading-relaxed">Temporarily hides an already-approved provider. Useful if there is an issue you need to investigate.</p>
        </div>
    </div>

    <div class="rounded-xl p-4 flex gap-3" style="background:#fffbeb; border:1px solid #fde68a;">
        <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        <p class="text-sm text-amber-800 leading-relaxed"><strong>Things to check before approving:</strong> Make sure the provider has filled in their business name, suburb/state, and at least one service category. A provider with a very incomplete profile may not be ready yet - you can always email them asking them to complete it before you approve.</p>
    </div>
</div>

{{-- ═══════ 4. FEATURED ═══════ --}}
<div id="featured" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 mb-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-amber-100">
            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
        </div>
        <h2 class="text-xl font-black text-gray-900">4. Featured Providers</h2>
    </div>
    <p class="text-gray-600 leading-relaxed mb-4">When you mark a provider as <strong>Featured</strong>, they get special placement - their listing appears in the "Featured Providers" section on the homepage and at the top of search results with a gold star ribbon. This is a great way to highlight providers who have a complete, high-quality profile.</p>

    <h3 class="font-black text-gray-800 mb-3">How to feature a provider</h3>
    <div class="space-y-2 mb-5">
        @foreach([
            'Go to Providers in the left sidebar.',
            'Find the approved provider you want to feature.',
            'Click the "View" button to open their profile.',
            'Click the "Feature" button (it looks like a star). The button will toggle - click it again to remove featured status.',
        ] as $i => $step)
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="w-5 h-5 rounded-full flex items-center justify-center text-xs font-black text-white flex-shrink-0 mt-0.5" style="background:#d97706;">{{ $i+1 }}</span>
            <p class="leading-relaxed">{{ $step }}</p>
        </div>
        @endforeach
    </div>
    <div class="rounded-xl p-4 flex gap-3" style="background:#fffbeb; border:1px solid #fde68a;">
        <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-sm text-amber-800 leading-relaxed">Featured status is purely visual - it does not change anything about the provider's subscription or account. You can feature and un-feature providers at any time. There is no limit to how many you can feature.</p>
    </div>
</div>

{{-- ═══════ 5. SUBSCRIPTIONS ═══════ --}}
<div id="subscriptions" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 mb-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-blue-100">
            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
        </div>
        <h2 class="text-xl font-black text-gray-900">5. Subscriptions</h2>
    </div>
    <p class="text-gray-600 leading-relaxed mb-5">The <strong>Subscriptions</strong> page shows you the payment and trial status of every provider. This helps you keep track of who is on a free trial, who is paying, and whose subscription has expired.</p>

    <h3 class="font-black text-gray-800 mb-3">Understanding subscription statuses</h3>
    <div class="space-y-3 mb-6">
        @foreach([
            ['badge'=>'Trial','color'=>'blue','desc'=>'This provider is in their free 3-month trial period. Their listing is fully live and visible to families. The trial end date is shown in the table so you know when it expires.'],
            ['badge'=>'Active','color'=>'green','desc'=>'This provider is on a paid subscription. Their listing is fully live. The renewal date is shown in the table.'],
            ['badge'=>'Expired','color'=>'red','desc'=>'This provider\'s trial or subscription has ended. Their listing is automatically hidden from the public site until they renew. They receive automated reminder emails before expiry.'],
        ] as $item)
        <div class="flex items-start gap-3 rounded-xl p-3.5" style="background:#f9fafb; border:1px solid #f0f0f0;">
            <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-black text-{{ $item['color'] }}-700 bg-{{ $item['color'] }}-100 flex-shrink-0 mt-0.5">{{ $item['badge'] }}</span>
            <p class="text-sm text-gray-600 leading-relaxed">{{ $item['desc'] }}</p>
        </div>
        @endforeach
    </div>

    <div class="rounded-xl p-4 flex gap-3 mb-4" style="background:#eff6ff; border:1px solid #bfdbfe;">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-sm text-blue-800 leading-relaxed"><strong>You do not need to manually process payments.</strong> Stripe (the payment system) handles all payments automatically. When a provider pays, their status updates to "Active" on its own. You mainly use this page to check on providers, not to take actions.</p>
    </div>

    <div class="rounded-xl p-4 flex gap-3" style="background:#fef2f2; border:1px solid #fecaca;">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        <p class="text-sm text-red-800 leading-relaxed"><strong>If a provider contacts you saying their listing disappeared:</strong> Check their subscription status here. If it shows "Expired", they need to renew their subscription through their own dashboard. You can point them to the provider guide at /guide/providers.</p>
    </div>
</div>

{{-- ═══════ 6. REVIEWS ═══════ --}}
<div id="reviews" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 mb-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-yellow-100">
            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
        </div>
        <h2 class="text-xl font-black text-gray-900">6. Moderating Reviews</h2>
    </div>
    <p class="text-gray-600 leading-relaxed mb-5">Families can leave star ratings and written reviews on any provider's profile. However, <strong>reviews are not published immediately</strong> - they sit in a queue waiting for you to approve them first. This protects providers from unfair or inappropriate comments.</p>

    <h3 class="font-black text-gray-800 mb-3">How to approve or reject a review</h3>
    <div class="space-y-2 mb-5">
        @foreach([
            'Click "Reviews" in the left sidebar.',
            'You will see all reviews waiting to be moderated. Each one shows the reviewer\'s name, the provider being reviewed, the star rating, and the written comment.',
            'Read the comment carefully.',
            'Click "Approve" if the review seems genuine and appropriate - it will immediately appear on the provider\'s public profile.',
            'Click "Reject" if the review contains offensive language, personal attacks, spam, or seems fake.',
        ] as $i => $step)
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="w-5 h-5 rounded-full flex items-center justify-center text-xs font-black text-white flex-shrink-0 mt-0.5" style="background:#ca8a04;">{{ $i+1 }}</span>
            <p class="leading-relaxed">{{ $step }}</p>
        </div>
        @endforeach
    </div>

    <h3 class="font-black text-gray-800 mb-3">What to look for when moderating</h3>
    <div class="grid sm:grid-cols-2 gap-3">
        <div class="rounded-xl p-4" style="background:#f0fdf4; border:1px solid #bbf7d0;">
            <p class="font-black text-green-700 text-sm mb-2">Approve if the review...</p>
            <ul class="space-y-1 text-xs text-gray-600">
                <li class="flex items-start gap-2"><span class="text-green-500 mt-0.5">✓</span>Describes a real experience with the provider</li>
                <li class="flex items-start gap-2"><span class="text-green-500 mt-0.5">✓</span>Is respectful even if the rating is low</li>
                <li class="flex items-start gap-2"><span class="text-green-500 mt-0.5">✓</span>Contains useful information for other families</li>
            </ul>
        </div>
        <div class="rounded-xl p-4" style="background:#fef2f2; border:1px solid #fecaca;">
            <p class="font-black text-red-700 text-sm mb-2">Reject if the review...</p>
            <ul class="space-y-1 text-xs text-gray-600">
                <li class="flex items-start gap-2"><span class="text-red-400 mt-0.5">✗</span>Contains rude, hateful, or offensive language</li>
                <li class="flex items-start gap-2"><span class="text-red-400 mt-0.5">✗</span>Looks like spam or is clearly not genuine</li>
                <li class="flex items-start gap-2"><span class="text-red-400 mt-0.5">✗</span>Shares private personal information</li>
                <li class="flex items-start gap-2"><span class="text-red-400 mt-0.5">✗</span>Seems to be from a competitor rather than a real family</li>
            </ul>
        </div>
    </div>
</div>

{{-- ═══════ 7. BLOG ═══════ --}}
<div id="blog" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 mb-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-rose-100">
            <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
        </div>
        <h2 class="text-xl font-black text-gray-900">7. Writing Blog Posts</h2>
    </div>
    <p class="text-gray-600 leading-relaxed mb-5">The blog section lets you publish articles, tips, and updates for families and providers. Blog posts appear at <strong>/blog</strong> on the public website. This is a great way to share helpful content, updates about the platform, or health tips for families.</p>

    <h3 class="font-black text-gray-800 mb-3">How to create a new blog post</h3>
    <div class="space-y-2 mb-6">
        @foreach([
            'Click "Blog" in the left sidebar.',
            'Click the green "New Post" button in the top right corner.',
            'Fill in the title - keep it clear and descriptive (e.g. "How to find a speech pathologist for your child").',
            'Write your content in the large text area. You can use basic formatting.',
            'Add a short "excerpt" - this is the 1-2 sentence summary that appears in the blog listing page.',
            'Choose a category if relevant.',
            'Toggle "Published" to ON when you are ready for it to go live. If you leave it OFF, the post is saved as a draft that only you can see.',
            'Click "Save Post".',
        ] as $i => $step)
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="w-5 h-5 rounded-full flex items-center justify-center text-xs font-black text-white flex-shrink-0 mt-0.5" style="background:#e11d48;">{{ $i+1 }}</span>
            <p class="leading-relaxed">{{ $step }}</p>
        </div>
        @endforeach
    </div>

    <h3 class="font-black text-gray-800 mb-3">Editing and deleting posts</h3>
    <p class="text-gray-600 text-sm leading-relaxed mb-4">On the Blog page, you will see a list of all posts. Click <strong>Edit</strong> to update a post at any time. Click <strong>Delete</strong> to permanently remove it. Be careful with Delete - it cannot be undone.</p>

    <div class="rounded-xl p-4 flex gap-3" style="background:#fff1f2; border:1px solid #fecdd3;">
        <svg class="w-5 h-5 text-rose-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-sm text-rose-800 leading-relaxed"><strong>SEO tip:</strong> The "slug" field (the web address for the post) is automatically generated from the title. For example, a title of "Tips for finding a provider" becomes /blog/tips-for-finding-a-provider. You can change this if needed but keep it lowercase with hyphens between words.</p>
    </div>
</div>

{{-- ═══════ 8. SETTINGS ═══════ --}}
<div id="settings" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 mb-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-gray-100">
            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
        </div>
        <h2 class="text-xl font-black text-gray-900">8. Platform Settings</h2>
    </div>
    <p class="text-gray-600 leading-relaxed mb-5">The Settings section lives at the bottom of your Admin Dashboard page (scroll down on the dashboard). It controls a few important options for how the platform works.</p>

    <div class="space-y-4 mb-5">
        <div class="rounded-xl p-5" style="background:#f9fafb; border:1px solid #e5e7eb;">
            <p class="font-black text-gray-800 text-sm mb-1.5">Free Trial Duration</p>
            <p class="text-sm text-gray-500 leading-relaxed">This controls how many months new providers get for free before they need to pay. It is currently set to <strong>3 months</strong>. If you change this number, it only affects new providers who sign up after the change - existing providers keep their original trial length.</p>
        </div>
        <div class="rounded-xl p-5" style="background:#f9fafb; border:1px solid #e5e7eb;">
            <p class="font-black text-gray-800 text-sm mb-1.5">Homepage Hero Title</p>
            <p class="text-sm text-gray-500 leading-relaxed">This is the large headline text that appears on the homepage hero banner. You can update this at any time to change the message families see when they first visit the site.</p>
        </div>
        <div class="rounded-xl p-5" style="background:#f9fafb; border:1px solid #e5e7eb;">
            <p class="font-black text-gray-800 text-sm mb-1.5">Homepage Hero Subtitle</p>
            <p class="text-sm text-gray-500 leading-relaxed">The smaller supporting text that appears below the headline on the homepage. Keep it short and welcoming - one or two sentences maximum.</p>
        </div>
    </div>

    <div class="rounded-xl p-4 flex gap-3" style="background:#fef2f2; border:1px solid #fecaca;">
        <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        <p class="text-sm text-red-800 leading-relaxed"><strong>Important:</strong> After changing any settings, always click the "Save Settings" button at the bottom of the form. If you navigate away without saving, your changes will be lost.</p>
    </div>
</div>

{{-- ═══════ 9. PRICING SETTINGS ═══════ --}}
<div id="pricing-settings" class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 mb-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:#fff0ea;">
            <svg class="w-5 h-5" style="color:#de6148;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h2 class="text-xl font-black text-gray-900">9. Pricing Settings</h2>
    </div>
    <p class="text-gray-600 leading-relaxed mb-5">The <strong>Pricing tab</strong> inside Settings lets you control everything that appears on the public <strong>/pricing</strong> page — the plan prices, the feature bullet lists, and the comparison table rows. Changes take effect the moment you save.</p>

    <p class="text-sm text-gray-500 mb-5 rounded-xl p-4" style="background:#f9fafb; border:1px solid #e5e7eb;">
        To reach it: go to the <strong>Admin Dashboard</strong> and scroll to the bottom. You will see a <em>Settings</em> card with two tabs at the top — <strong>General</strong> and <strong>Pricing</strong>. Click the <strong>Pricing</strong> tab.
    </p>

    <h3 class="font-black text-gray-800 mb-3">Plan Prices</h3>
    <p class="text-sm text-gray-600 leading-relaxed mb-5">Enter the dollar amounts (AUD, whole numbers) for each plan. The pricing page automatically works out the per-month figure for the annual plan and shows a "Save $X" badge if the annual plan is cheaper than 12 months of monthly billing.</p>

    <h3 class="font-black text-gray-800 mb-3">Feature Bullet Lists</h3>
    <p class="text-sm text-gray-600 leading-relaxed mb-3">There are two separate bullet lists — one for the <strong>Monthly</strong> plan card and one for the <strong>Annual</strong> plan card. Each line of text becomes a single bullet point on the pricing page.</p>
    <div class="space-y-2 mb-5">
        @foreach([
            'To add a bullet: click the orange "+ Add Item" button. A new text field appears at the bottom of the list.',
            'To edit a bullet: click inside the text field and type your changes.',
            'To remove a bullet: click the red × button on the right of that row.',
            'To reorder bullets: remove the one you want to move and re-add it in the right position. (Drag-and-drop is not available yet.)',
        ] as $i => $step)
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="w-5 h-5 rounded-full flex items-center justify-center text-xs font-black text-white flex-shrink-0 mt-0.5" style="background:#de6148;">{{ $i+1 }}</span>
            <p class="leading-relaxed">{{ $step }}</p>
        </div>
        @endforeach
    </div>

    <h3 class="font-black text-gray-800 mb-3">Comparison Table</h3>
    <p class="text-sm text-gray-600 leading-relaxed mb-3">This is the table on the pricing page that shows which features are included in each plan with tick / cross icons. Each row has three parts:</p>
    <div class="grid sm:grid-cols-3 gap-3 mb-5">
        <div class="rounded-xl p-4" style="background:#f9fafb; border:1px solid #e5e7eb;">
            <p class="font-black text-gray-800 text-sm mb-1">Feature Label</p>
            <p class="text-xs text-gray-500 leading-relaxed">The name of the feature — e.g. "Telehealth badge". This is the text families read in the left column.</p>
        </div>
        <div class="rounded-xl p-4" style="background:#f9fafb; border:1px solid #e5e7eb;">
            <p class="font-black text-sm mb-1" style="color:#de6148;">Monthly checkbox</p>
            <p class="text-xs text-gray-500 leading-relaxed">Tick this if the feature is included in the monthly plan. A tick on the pricing page means ✓; no tick means ✗.</p>
        </div>
        <div class="rounded-xl p-4" style="background:#f9fafb; border:1px solid #e5e7eb;">
            <p class="font-black text-sm mb-1" style="color:#c4920a;">Annual checkbox</p>
            <p class="text-xs text-gray-500 leading-relaxed">Tick this if the feature is included in the annual plan.</p>
        </div>
    </div>
    <div class="space-y-2 mb-5">
        @foreach([
            'To add a row: click "+ Add Row". A new empty row appears at the bottom of the table.',
            'To remove a row: click the red × button on the right of that row.',
            'Tip: features that are in both plans show ✓ ✓. Features exclusive to annual show ✗ ✓ — a great way to highlight the annual advantage.',
        ] as $i => $tip)
        <div class="flex items-start gap-3 text-sm text-gray-600">
            <span class="w-5 h-5 rounded-full flex items-center justify-center text-xs font-black text-white flex-shrink-0 mt-0.5" style="background:#de6148;">{{ $i+1 }}</span>
            <p class="leading-relaxed">{{ $tip }}</p>
        </div>
        @endforeach
    </div>

    <div class="rounded-xl p-4 flex gap-3 mb-4" style="background:#fff0ea; border:1px solid #fed7aa;">
        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" style="color:#de6148;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-2.694-.833-3.464 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
        <p class="text-sm leading-relaxed" style="color:#92400e;"><strong>Important:</strong> The Pricing tab has its own <em>"Save Pricing Settings"</em> button. Always click it before switching tabs or navigating away. If you switch to the General tab without saving, your pricing changes will be lost.</p>
    </div>

    <div class="rounded-xl p-4 flex gap-3" style="background:#eff6ff; border:1px solid #bfdbfe;">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <p class="text-sm text-blue-800 leading-relaxed"><strong>Changing the price does not update Stripe.</strong> The dollar amounts here are display-only — they control what visitors see on the pricing page. The actual payment amounts are set separately in your Stripe dashboard under Products → Prices. If you change prices, make sure to update both places and let your developer know.</p>
    </div>
</div>

{{-- ═══════ 10. COMMON Q&A ═══════ --}}
<div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-7 mb-6">
    <div class="flex items-center gap-3 mb-5">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-violet-100">
            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <h2 class="text-xl font-black text-gray-900">10. Common Questions</h2>
    </div>
    <div class="space-y-4" x-data="{ open: null }">
        @foreach([
            ['q'=>'A provider says their listing has disappeared - what do I do?', 'a'=>'First, check their subscription status on the Subscriptions page. If it says "Expired", their trial or subscription has ended and their listing was automatically hidden. Let them know they need to log in to their dashboard and set up a subscription to reactivate their listing. If the status looks fine, check whether they are still "Approved" on the Providers page - they may have been accidentally suspended.'],
            ['q'=>'A provider wants to update their listing - can I do this for them?', 'a'=>'No - providers update their own listings through their own dashboard. You cannot edit a provider\'s profile from the admin panel. Ask them to log in at /login and go to their Profile Settings. If they are having trouble, they can visit /guide/providers for step-by-step instructions.'],
            ['q'=>'Can I delete a provider account entirely?', 'a'=>'Currently the admin panel does not have a one-click delete option for provider accounts. You can Reject or Suspend a provider to remove them from the public site. If you need an account permanently removed, this would require technical assistance from your developer.'],
            ['q'=>'How do I know when a new provider has signed up?', 'a'=>'The Dashboard shows "Pending Approval" count. You will also receive an email notification when a new provider registers. Make it a habit to check the dashboard regularly (at least a few times a week) so providers are not left waiting too long.'],
            ['q'=>'Can families contact providers through the platform?', 'a'=>'Yes - families with an account can send appointment requests and messages to providers through the platform\'s messaging system. You cannot read these private messages from the admin panel.'],
            ['q'=>'How do I add a new service category?', 'a'=>'New categories need to be added by your developer - they are stored in the database and currently can only be changed through a migration or by your developer running a database update. Keep a list of any new categories you need and pass them on.'],
        ] as $i => $item)
        <div class="rounded-xl overflow-hidden" style="border:1px solid #e5e7eb;" x-data="{ open: false }">
            <button @click="open = !open" class="w-full flex items-center justify-between p-4 text-left bg-gray-50 hover:bg-gray-100 transition-colors">
                <span class="font-bold text-gray-800 text-sm pr-4">{{ $item['q'] }}</span>
                <svg class="w-4 h-4 text-gray-400 flex-shrink-0 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <div x-show="open" x-transition class="px-4 pb-4 pt-3">
                <p class="text-sm text-gray-600 leading-relaxed">{{ $item['a'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- Bottom nav --}}
<div class="flex items-center justify-between">
    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-bold transition-colors" style="background:#f5f3ff; color:#6d28d9;">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Back to Dashboard
    </a>
    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl px-5 py-2.5 text-sm font-bold transition-colors bg-gray-100 text-gray-700 hover:bg-gray-200">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
        View Public Site
    </a>
</div>

@endsection

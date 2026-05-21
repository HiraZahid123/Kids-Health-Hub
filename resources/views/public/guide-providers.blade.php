@extends('layouts.public')
@section('title', 'Guide for Providers — Kids Health Hub')
@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('guide') }}" class="hover:text-emerald-600 font-medium">Help Centre</a>
            <span>/</span>
            <span class="text-gray-800 font-semibold">Guide for Providers</span>
        </nav>

        <div class="bg-emerald-600 rounded-2xl p-8 mb-8 text-white">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-black">Guide for Providers</h1>
                    <p class="text-emerald-200 text-sm">Everything you need to manage your listing and reach more families</p>
                </div>
            </div>
        </div>

        <div class="space-y-6">

            @foreach([
                ['num'=>'1','title'=>'Creating Your Account','content'=>'<p class="text-gray-600 mb-3">Click <strong>List Your Practice</strong> in the top navigation. You\'ll complete a registration form with:</p><ul class="list-disc list-inside text-gray-600 space-y-2 ml-2"><li>Business name and contact details</li><li>Your service address and suburb</li><li>Practice categories (Speech Pathology, OT, Psychology, etc.)</li></ul><p class="text-gray-600 mt-3">After registration, your account enters <strong>Pending Review</strong>. Our admin team will approve your listing, typically within 1–2 business days.</p>'],
                ['num'=>'2','title'=>'Free Trial & Subscriptions','content'=>'<p class="text-gray-600 mb-3">Every new provider receives a <strong>3-month free trial</strong> — no credit card required. Your listing is fully active during the trial period.</p><p class="text-gray-600 mb-3">Before your trial expires, you\'ll receive email reminders to set up your subscription via Stripe. Subscription plans:</p><ul class="list-disc list-inside text-gray-600 space-y-2 ml-2"><li><strong>Solo</strong> — Individual practitioners</li><li><strong>Company</strong> — Multi-practitioner clinics</li></ul><p class="text-gray-500 text-sm italic mt-2">When your subscription expires, your listing is hidden from search results until renewed.</p>'],
                ['num'=>'3','title'=>'Completing Your Profile','content'=>'<p class="text-gray-600 mb-3">A complete profile gets significantly more enquiries. Go to <strong>Dashboard → Profile Settings</strong> to fill in:</p><ul class="list-disc list-inside text-gray-600 space-y-2 ml-2"><li><strong>Profile image</strong> — your photo or clinic logo</li><li><strong>Bio</strong> — your approach, qualifications, and specialisations</li><li><strong>Age groups</strong> — infants, toddlers, school-age, teens</li><li><strong>Funding types</strong> — NDIS, Medicare, Private, etc.</li><li><strong>Service delivery</strong> — In-clinic, mobile visits, telehealth</li><li><strong>Contact details</strong> — phone, email, website URL</li><li><strong>Wait time</strong> — how long families typically wait</li></ul>'],
                ['num'=>'4','title'=>'Managing Availability','content'=>'<p class="text-gray-600 mb-3">Keep your availability status current so families know whether you\'re accepting new patients.</p><p class="text-gray-600 mb-3">From your <strong>Dashboard</strong>, use the <strong>Toggle Availability</strong> button to switch between:</p><ul class="list-disc list-inside text-gray-600 space-y-2 ml-2"><li><span class="text-emerald-700 font-semibold">Available</span> — green badge shown on your listing</li><li><span class="text-gray-500 font-semibold">Unavailable</span> — no badge shown</li></ul><p class="text-gray-600 mt-3">You can also toggle <strong>Telehealth</strong> availability separately.</p>'],
                ['num'=>'5','title'=>'Managing Appointments','content'=>'<p class="text-gray-600 mb-3">When families submit appointment requests, you\'ll see them under <strong>Dashboard → Appointments</strong>. For each request you can:</p><ul class="list-disc list-inside text-gray-600 space-y-2 ml-2"><li><strong>Accept</strong> — confirm the appointment</li><li><strong>Decline</strong> — with an optional reason</li></ul><p class="text-gray-600 mt-3">Use the <strong>Messages</strong> section to communicate with families regarding their requests.</p>'],
                ['num'=>'6','title'=>'Understanding Your Analytics','content'=>'<p class="text-gray-600 mb-3">Your dashboard shows key metrics to help you understand your listing\'s performance:</p><ul class="list-disc list-inside text-gray-600 space-y-2 ml-2"><li><strong>Profile views</strong> — how many times your profile was viewed</li><li><strong>Reviews</strong> — star ratings and comments from families</li><li><strong>Subscription status</strong> — trial/active/expired + expiry date</li></ul>'],
            ] as $step)
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="flex items-center gap-4 p-6 border-b border-gray-50">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <span class="text-emerald-700 font-black text-sm">{{ $step['num'] }}</span>
                    </div>
                    <h2 class="text-lg font-black text-gray-900">{{ $step['title'] }}</h2>
                </div>
                <div class="p-6">{!! $step['content'] !!}</div>
            </div>
            @endforeach

        </div>

        <div class="mt-8 flex gap-3 flex-wrap">
            <a href="{{ route('register') }}" class="bg-emerald-600 text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-emerald-700 transition-colors">List Your Practice Free</a>
            <a href="{{ route('guide.faq') }}" class="bg-white border-2 border-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold text-sm hover:border-emerald-300 hover:text-emerald-700 transition-colors">View FAQ</a>
        </div>
    </div>
</div>
@endsection

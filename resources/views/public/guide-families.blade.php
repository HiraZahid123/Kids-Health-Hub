@extends('layouts.public')
@section('title', 'Guide for Families — Kids Health Hub')
@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('guide') }}" class="hover:text-emerald-600 font-medium">Help Centre</a>
            <span>/</span>
            <span class="text-gray-800 font-semibold">Guide for Families</span>
        </nav>

        <div class="bg-sky-600 rounded-2xl p-8 mb-8 text-white">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 bg-sky-500 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                </div>
                <div>
                    <h1 class="text-2xl font-black">Guide for Families</h1>
                    <p class="text-sky-200 text-sm">Find and connect with the right provider for your child</p>
                </div>
            </div>
        </div>

        <div class="space-y-6">

            @foreach([
                ['num'=>'1','title'=>'Searching for Providers','content'=>'<p class="text-gray-600 mb-3">Start from the homepage or the <strong>Find Providers</strong> page. Use the search bar to enter a suburb, postcode, or provider name.</p><ul class="list-disc list-inside text-gray-600 space-y-2 ml-2"><li><strong>Location search</strong> - type any Sydney suburb, Melbourne postcode, etc.</li><li><strong>Category filter</strong> - narrow by type (Speech Pathology, Psychology, OT, etc.)</li><li><strong>Near Me</strong> - browser-based geolocation shows providers closest to you</li><li><strong>Telehealth toggle</strong> - shows only providers offering online consultations</li></ul>'],
                ['num'=>'2','title'=>'Understanding Provider Cards','content'=>'<p class="text-gray-600 mb-3">Each card shows key information at a glance:</p><ul class="list-disc list-inside text-gray-600 space-y-2 ml-2"><li><span class="inline-flex items-center gap-1 text-emerald-700 font-semibold text-sm bg-emerald-50 px-2 py-0.5 rounded-full">● Available</span> - currently accepting new patients</li><li><span class="inline-flex items-center gap-1 text-blue-700 font-semibold text-sm bg-blue-50 px-2 py-0.5 rounded-full">Telehealth</span> - online appointments available</li><li><strong>Star rating</strong> - average rating from verified family reviews</li><li><strong>Wait time</strong> - estimated time before first appointment</li></ul>'],
                ['num'=>'3','title'=>'Viewing a Provider Profile','content'=>'<p class="text-gray-600 mb-3">Click any provider card to open their full profile. You\'ll find:</p><ul class="list-disc list-inside text-gray-600 space-y-2 ml-2"><li>Full bio, specialisations, and approach</li><li>Age groups they work with (0-5, 5-12, Teens, etc.)</li><li>Funding types accepted (NDIS, Medicare, Private, etc.)</li><li>Service delivery modes (In-clinic, Home visits, Telehealth)</li><li>Contact details - phone, email, website</li><li>Location map</li><li>Reviews from other families</li></ul>'],
                ['num'=>'4','title'=>'Saving Providers','content'=>'<p class="text-gray-600 mb-3">Create a free family account to save providers you\'re interested in. Click the <strong>heart icon</strong> on any provider card or profile to save them to your list.</p><p class="text-gray-600">Access your saved providers anytime from your <strong>My Account</strong> dashboard.</p>'],
                ['num'=>'5','title'=>'Writing a Review','content'=>'<p class="text-gray-600 mb-3">After using a provider\'s services, share your experience to help other families. From the provider\'s profile, scroll to the <strong>Reviews</strong> section and click <strong>Write a Review</strong>.</p><p class="text-gray-500 text-sm italic">Reviews are moderated before appearing publicly.</p>'],
                ['num'=>'6','title'=>'Requesting an Appointment','content'=>'<p class="text-gray-600 mb-3">Logged-in family members can submit an appointment request directly from any provider\'s profile. The provider will respond through the platform\'s messaging system.</p><p class="text-gray-500 text-sm italic">Note: This is a request only - appointment confirmation happens directly with the provider.</p>'],
            ] as $step)
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden">
                <div class="flex items-center gap-4 p-6 border-b border-gray-50">
                    <div class="w-10 h-10 bg-sky-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <span class="text-sky-700 font-black text-sm">{{ $step['num'] }}</span>
                    </div>
                    <h2 class="text-lg font-black text-gray-900">{{ $step['title'] }}</h2>
                </div>
                <div class="p-6">{!! $step['content'] !!}</div>
            </div>
            @endforeach

        </div>

        <div class="mt-8 flex gap-3 flex-wrap">
            <a href="{{ route('providers.index') }}" class="bg-sky-600 text-white px-6 py-3 rounded-xl font-bold text-sm hover:bg-sky-700 transition-colors">Find Providers Now</a>
            <a href="{{ route('guide.faq') }}" class="bg-white border-2 border-gray-200 text-gray-700 px-6 py-3 rounded-xl font-bold text-sm hover:border-sky-300 hover:text-sky-700 transition-colors">View FAQ</a>
        </div>
    </div>
</div>
@endsection

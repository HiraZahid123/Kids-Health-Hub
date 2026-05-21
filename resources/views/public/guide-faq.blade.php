@extends('layouts.public')
@section('title', 'FAQ — Kids Health Hub')
@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

        <nav class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <a href="{{ route('guide') }}" class="hover:text-emerald-600 font-medium">Help Centre</a>
            <span>/</span>
            <span class="text-gray-800 font-semibold">FAQ</span>
        </nav>

        <div class="text-center mb-10">
            <h1 class="text-4xl font-black text-gray-900 mb-3">Frequently Asked Questions</h1>
            <p class="text-gray-500">Quick answers to the most common questions about Kids Health Hub.</p>
        </div>

        <div x-data="{ open: null }" class="space-y-3">
            @foreach([
                ['q'=>'Is Kids Health Hub free for families?','a'=>'Yes — browsing, searching, and viewing provider profiles is completely free for families. Creating a family account to save providers and leave reviews is also free.'],
                ['q'=>'How do I find a provider near me?','a'=>'Use the search bar on the homepage or Find Providers page. Enter your suburb or postcode, or click "Near Me" to use your device\'s location. You can also filter by category, age group, and funding type.'],
                ['q'=>'What is the green "Available" badge?','a'=>'Providers with the green Available badge are currently accepting new patients. This status is set by the provider and updated in real time from their dashboard.'],
                ['q'=>'Are providers verified?','a'=>'All provider listings are reviewed and approved by our admin team before appearing publicly. However, we encourage families to verify professional registrations directly with the relevant Australian registration bodies (e.g., AHPRA).'],
                ['q'=>'How do I list my practice?','a'=>'Click "List Your Practice" in the top navigation and complete the registration form. New providers receive a free 3-month trial — no credit card required. Your listing will be reviewed and activated within 1–2 business days.'],
                ['q'=>'What happens when my trial expires?','a'=>'Your listing will be hidden from search results until you activate a paid subscription. You\'ll receive email reminders before your trial ends so you can set up payment through Stripe without any interruption.'],
                ['q'=>'Can I offer telehealth services on Kids Health Hub?','a'=>'Yes. Toggle the Telehealth option from your provider dashboard. Your listing will then show the blue "Telehealth" badge, and families can filter specifically for telehealth providers.'],
                ['q'=>'How does the review system work?','a'=>'Families with an account can leave a star rating and written review on any provider\'s profile. Reviews are moderated by our team before being published to maintain quality and prevent misuse.'],
                ['q'=>'Can I save multiple providers?','a'=>'Yes. With a free family account, you can save unlimited providers to your saved list and access them anytime from your My Account dashboard.'],
                ['q'=>'What funding types are listed?','a'=>'Providers can indicate which funding types they accept, including NDIS (registered and unregistered), Medicare, Private health insurance, and self-funded. Use the filters on the provider search page to find providers matching your funding situation.'],
            ] as $i => $faq)
            <div class="bg-white rounded-xl border border-gray-100 overflow-hidden" x-data>
                <button @click="$root.open === {{ $i }} ? $root.open = null : $root.open = {{ $i }}"
                        class="w-full flex items-center justify-between p-5 text-left gap-4">
                    <span class="font-bold text-gray-900 text-sm leading-snug">{{ $faq['q'] }}</span>
                    <svg class="w-5 h-5 text-gray-400 flex-shrink-0 transition-transform duration-200"
                         :class="$root.open === {{ $i }} ? 'rotate-180' : ''"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <div x-show="$root.open === {{ $i }}" x-transition class="px-5 pb-5 text-gray-600 text-sm leading-relaxed border-t border-gray-50 pt-4">
                    {{ $faq['a'] }}
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-10 bg-emerald-50 border border-emerald-100 rounded-2xl p-6 text-center">
            <p class="text-gray-700 font-semibold mb-1">Can't find what you're looking for?</p>
            <p class="text-gray-500 text-sm mb-4">Ask the community or browse our detailed guides.</p>
            <div class="flex justify-center gap-3 flex-wrap">
                <a href="{{ route('community.index') }}" class="bg-emerald-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-700 transition-colors">Ask the Community</a>
                <a href="{{ route('guide') }}" class="bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl text-sm font-bold hover:border-emerald-300 transition-colors">Back to Help Centre</a>
            </div>
        </div>
    </div>
</div>
@endsection

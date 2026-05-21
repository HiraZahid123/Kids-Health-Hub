@extends('layouts.public')

@section('title', 'Help Centre — Kids Health Hub')
@section('meta_description', 'Learn how to use Kids Health Hub to find child healthcare providers or list your practice.')

@section('content')
<div class="bg-gray-50 py-12 border-b border-gray-100 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header -->
        <div class="text-center mb-12">
            <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-4 py-2 rounded-full mb-4 uppercase tracking-widest">Help Centre</span>
            <h1 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4 tracking-tight">How can we help?</h1>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto">Find everything you need to know about using Kids Health Hub — whether you're a family searching for support or a provider listing your practice.</p>
        </div>

        <!-- Guide Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-14">
            <a href="{{ route('guide.families') }}" class="card-hover bg-white rounded-2xl border-2 border-gray-100 p-8 block group">
                <div class="w-14 h-14 bg-sky-100 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-sky-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0"/></svg>
                </div>
                <h2 class="text-xl font-black text-gray-900 mb-2 group-hover:text-sky-700 transition-colors">For Families</h2>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">How to search for providers, save favourites, request appointments, and write reviews.</p>
                <span class="text-sky-600 text-sm font-bold">Read guide →</span>
            </a>
            <a href="{{ route('guide.providers') }}" class="card-hover bg-white rounded-2xl border-2 border-gray-100 p-8 block group">
                <div class="w-14 h-14 bg-emerald-100 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                </div>
                <h2 class="text-xl font-black text-gray-900 mb-2 group-hover:text-emerald-700 transition-colors">For Providers</h2>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">How to register, complete your profile, manage availability, subscriptions, and appointments.</p>
                <span class="text-emerald-600 text-sm font-bold">Read guide →</span>
            </a>
            <a href="{{ route('guide.faq') }}" class="card-hover bg-white rounded-2xl border-2 border-gray-100 p-8 block group">
                <div class="w-14 h-14 bg-violet-100 rounded-2xl flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <h2 class="text-xl font-black text-gray-900 mb-2 group-hover:text-violet-700 transition-colors">FAQ</h2>
                <p class="text-gray-500 text-sm leading-relaxed mb-4">Answers to the most common questions about our directory, pricing, listings, and policies.</p>
                <span class="text-violet-600 text-sm font-bold">Read FAQ →</span>
            </a>
        </div>

        <!-- Quick Tips -->
        <div class="bg-white rounded-2xl border border-gray-100 p-8 mb-10">
            <h2 class="text-xl font-black text-gray-900 mb-6">Quick Start</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach([
                    ['icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z','text'=>'Search by suburb, postcode, or provider name','link'=>route('providers.index'),'label'=>'Search now'],
                    ['icon'=>'M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z','text'=>'Filter by age group, telehealth, or funding type','link'=>route('providers.index'),'label'=>'Use filters'],
                    ['icon'=>'M15 10l4.553-2.069A1 1 0 0121 8.82v6.362a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z','text'=>'Find providers offering telehealth consultations','link'=>route('telehealth'),'label'=>'Telehealth providers'],
                    ['icon'=>'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z','text'=>'List your practice — free 3-month trial','link'=>route('register'),'label'=>'Register as provider'],
                ] as $tip)
                <div class="flex items-start gap-4 p-4 rounded-xl bg-gray-50">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $tip['icon'] }}"/></svg>
                    </div>
                    <div>
                        <p class="text-gray-700 text-sm font-medium mb-1">{{ $tip['text'] }}</p>
                        <a href="{{ $tip['link'] }}" class="text-emerald-600 text-xs font-bold hover:underline">{{ $tip['label'] }} →</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Still need help -->
        <div class="bg-emerald-700 rounded-2xl p-8 text-center text-white">
            <h3 class="text-xl font-black mb-2">Still have questions?</h3>
            <p class="text-emerald-200 text-sm mb-5">Browse our full FAQ or join the community to ask other families and providers.</p>
            <div class="flex justify-center gap-3 flex-wrap">
                <a href="{{ route('guide.faq') }}" class="bg-white text-emerald-700 px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-50 transition-colors">View FAQ</a>
                <a href="{{ route('community.index') }}" class="bg-emerald-600 border border-emerald-500 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-emerald-500 transition-colors">Join Community</a>
            </div>
        </div>

    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('title', 'Subscription Activated')
@section('page-title', 'Subscription Activated')



@section('content')
<div class="max-w-lg mx-auto text-center py-16">
    <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center text-4xl mx-auto mb-6">
        ✅
    </div>
    <h1 class="text-2xl font-bold text-gray-800 mb-3">You're all set!</h1>
    <p class="text-gray-600 mb-8">Your subscription is now active. Your listing is live and visible to families on Kids Health Hub.</p>
    <div class="flex flex-col sm:flex-row gap-3 justify-center">
        <a href="{{ route('provider.dashboard') }}" class="bg-emerald-500 hover:bg-emerald-600 text-white font-semibold px-6 py-3 rounded-xl transition-colors">
            Go to Dashboard
        </a>
        <a href="{{ route('providers.index') }}" target="_blank" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-6 py-3 rounded-xl transition-colors">
            View Provider Directory
        </a>
    </div>
</div>
@endsection

@extends('layouts.public')

@section('title', 'User Guide — Kids Health Hub')
@section('meta_description', 'Learn how to use Kids Health Hub to find child healthcare providers or list your practice.')

@section('content')
<div class="bg-gray-50 py-12 border-b border-gray-100 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center mb-12">
            <span class="inline-block bg-emerald-100 text-emerald-800 text-xs font-bold px-4 py-2 rounded-full mb-4 uppercase tracking-widest">
                Documentation
            </span>
            <h1 class="text-4xl sm:text-5xl font-black text-gray-900 mb-4 tracking-tight">Kids Health Hub Guide</h1>
            <p class="text-lg text-gray-500 max-w-2xl mx-auto">Everything you need to know to get the most out of our platform, whether you're a parent or a healthcare provider.</p>
        </div>

        <!-- Content -->
        <div class="space-y-8">
            
            <!-- Section: Overview -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-8">
                    <h2 class="text-2xl font-black text-gray-900 mb-4 flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        Welcome to Kids Health Hub
                    </h2>
                    <p class="text-gray-600 leading-relaxed mb-4">
                        Kids Health Hub is Australia's dedicated child healthcare directory. Our mission is to connect families with the right healthcare professionals for their children. Currently, our platform serves as a powerful discovery engine, allowing families to search, filter, and view detailed profiles of healthcare providers across the country.
                    </p>
                </div>
            </div>

            <!-- Section: For Families -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="border-b border-gray-50 bg-sky-50 p-8">
                    <h2 class="text-2xl font-black text-sky-900 mb-2 flex items-center gap-3">
                        <div class="w-10 h-10 bg-sky-200 rounded-xl flex items-center justify-center text-sky-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        Guide for Families & Parents
                    </h2>
                    <p class="text-sky-700 text-sm">How to find and connect with providers.</p>
                </div>
                <div class="p-8 space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">1. Searching for Providers</h3>
                        <p class="text-gray-600 mb-2">You can begin your search from the homepage or the "Find Providers" page. Simply enter a suburb, postcode, or the name of a specific provider. You can also filter by category (e.g., Speech Pathology, Psychology).</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-1 ml-2">
                            <li><strong>Near Me:</strong> Click the "Near Me" button to allow the browser to detect your location and show providers within a specific radius.</li>
                            <li><strong>Telehealth:</strong> If you prefer online consultations, use the Telehealth toggle to only see providers offering virtual appointments.</li>
                        </ul>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">2. Understanding Provider Profiles</h3>
                        <p class="text-gray-600 mb-2">Each provider profile contains essential details to help you make an informed decision:</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-1 ml-2">
                            <li><strong>Availability Status:</strong> Look for the green "Immediately Available" badge.</li>
                            <li><strong>Service Details:</strong> View the age groups they treat, funding types they accept (e.g., NDIS, Medicare), and their delivery methods (In-clinic, Mobile, Telehealth).</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">3. Contacting a Provider</h3>
                        <p class="text-gray-600">Once you've found a suitable provider, you can contact them directly using the details provided on their profile. You will typically find their phone number, email address, or a link to their external website. <br><em class="text-sm mt-1 inline-block text-gray-500">Note: In-platform appointment booking is not available in this phase.</em></p>
                    </div>
                </div>
            </div>

            <!-- Section: For Providers -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="border-b border-gray-50 bg-emerald-50 p-8">
                    <h2 class="text-2xl font-black text-emerald-900 mb-2 flex items-center gap-3">
                        <div class="w-10 h-10 bg-emerald-200 rounded-xl flex items-center justify-center text-emerald-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        Guide for Healthcare Providers
                    </h2>
                    <p class="text-emerald-700 text-sm">How to manage your listing and reach more families.</p>
                </div>
                <div class="p-8 space-y-6">
                    <div>
                        <h3 class="text-lg font-bold text-gray-800 mb-2">1. Creating an Account</h3>
                        <p class="text-gray-600">Click on "List Your Practice" in the top right corner. You'll need to provide your business details, contact information, and select your relevant categories. Creating an account gives you a free 3-month trial to experience the platform.</p>
                    </div>
                    
                    <div class="pt-4 border-t border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">2. The Provider Dashboard</h3>
                        <p class="text-gray-600 mb-2">Once logged in, your dashboard is your control center. Here you can:</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-1 ml-2">
                            <li>View profile statistics (how many times your profile has been viewed).</li>
                            <li>Quickly toggle your "Immediate Availability" status so families know you are accepting new patients right away.</li>
                            <li>Toggle your "Telehealth" status.</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">3. Managing Your Profile</h3>
                        <p class="text-gray-600">Navigate to "Profile Settings" from your dashboard. A complete profile significantly increases your chances of being contacted. Make sure to:</p>
                        <ul class="list-disc list-inside text-gray-600 space-y-1 ml-2 mt-2">
                            <li>Upload a clear profile image or clinic logo.</li>
                            <li>Write a comprehensive bio explaining your approach and expertise.</li>
                            <li>Select all applicable age groups and funding types (e.g., NDIS Registered, Medicare).</li>
                            <li>Ensure your contact details (phone, email, website) are up-to-date, as this is how families will reach you.</li>
                        </ul>
                    </div>

                    <div class="pt-4 border-t border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">4. Subscriptions</h3>
                        <p class="text-gray-600">You can manage your subscription under the "Subscription" tab in your dashboard. You will be notified when your free trial is ending, at which point you can securely set up your payment details via Stripe to keep your listing active.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="text-center mt-12 mb-8">
            <p class="text-gray-500 mb-4">Still have questions?</p>
            <a href="mailto:support@kidshealthhub.com.au" class="inline-flex items-center gap-2 bg-white border-2 border-gray-200 text-gray-700 hover:border-emerald-300 hover:text-emerald-700 font-bold px-6 py-3 rounded-xl transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Contact Support
            </a>
        </div>

    </div>
</div>
@endsection

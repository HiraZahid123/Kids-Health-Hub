@extends('layouts.public')
@section('title', 'New Post — Community')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('community.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-2xl font-black text-gray-900">Create New Post</h1>
        </div>

        <form method="POST" action="{{ route('community.store') }}" enctype="multipart/form-data" class="bg-white rounded-2xl border border-gray-100 p-8 space-y-5">
            @csrf

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                <ul class="text-red-700 text-sm space-y-1 list-disc list-inside">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
            @endif

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" value="{{ old('title') }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white"
                       placeholder="What would you like to discuss?" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Category</label>
                <input type="text" name="category" value="{{ old('category') }}"
                       list="category-options"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white"
                       placeholder="e.g. Speech Pathology, NDIS, School Readiness">
                <datalist id="category-options">
                    <option value="Speech Pathology">
                    <option value="Occupational Therapy">
                    <option value="Psychology">
                    <option value="NDIS">
                    <option value="Medicare">
                    <option value="School Readiness">
                    <option value="Early Intervention">
                    <option value="Telehealth">
                    <option value="General">
                </datalist>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Content <span class="text-red-500">*</span></label>
                <textarea name="content" rows="8"
                          class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white resize-y"
                          placeholder="Share your thoughts, question, or experience…" required>{{ old('content') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Image (optional)</label>
                <input type="file" name="image" accept="image/*"
                       class="w-full text-sm text-gray-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700 file:font-semibold hover:file:bg-emerald-100 cursor-pointer">
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-emerald-600 text-white py-3 rounded-xl font-bold hover:bg-emerald-700 transition-colors">Publish Post</button>
                <a href="{{ route('community.index') }}" class="px-5 py-3 border border-gray-200 text-gray-600 rounded-xl font-semibold hover:bg-gray-50 transition-colors text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

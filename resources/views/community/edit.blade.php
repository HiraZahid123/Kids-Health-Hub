@extends('layouts.public')
@section('title', 'Edit Post — Community')

@section('content')
<div class="bg-gray-50 min-h-screen py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('community.show', $post) }}" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="text-2xl font-black text-gray-900">Edit Post</h1>
        </div>

        <form method="POST" action="{{ route('community.update', $post) }}" class="bg-white rounded-2xl border border-gray-100 p-8 space-y-5">
            @csrf @method('PUT')

            @if($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                <ul class="text-red-700 text-sm space-y-1 list-disc list-inside">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
            @endif

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Title</label>
                <input type="text" name="title" value="{{ old('title', $post->title) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Category</label>
                <input type="text" name="category" value="{{ old('category', $post->category) }}"
                       class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white">
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1.5">Content</label>
                <textarea name="content" rows="10"
                          class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white resize-y" required>{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-emerald-600 text-white py-3 rounded-xl font-bold hover:bg-emerald-700 transition-colors">Update Post</button>
                <a href="{{ route('community.show', $post) }}" class="px-5 py-3 border border-gray-200 text-gray-600 rounded-xl font-semibold hover:bg-gray-50 transition-colors text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection

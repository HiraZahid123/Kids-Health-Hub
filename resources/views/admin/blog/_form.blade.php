<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    @if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl p-4">
        <ul class="text-red-700 text-sm space-y-1 list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Main content --}}
        <div class="lg:col-span-2 space-y-5">
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-5">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" value="{{ old('title', $post?->title) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 focus:border-transparent bg-gray-50 focus:bg-white"
                           placeholder="Post title" required>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Excerpt</label>
                    <textarea name="excerpt" rows="2"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 focus:border-transparent bg-gray-50 focus:bg-white resize-none"
                              placeholder="Short summary (shown in blog listing)">{{ old('excerpt', $post?->excerpt) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1.5">Content <span class="text-red-500">*</span></label>
                    <textarea name="content" rows="18"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 focus:border-transparent bg-gray-50 focus:bg-white resize-y font-mono"
                              placeholder="Write your post content here..." required>{{ old('content', $post?->content) }}</textarea>
                </div>
            </div>

            {{-- SEO --}}
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <h3 class="font-bold text-gray-900 text-sm">SEO (optional)</h3>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Meta Title</label>
                    <input type="text" name="meta_title" value="{{ old('meta_title', $post?->meta_title) }}"
                           class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white"
                           placeholder="Override page title for search engines">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Meta Description</label>
                    <textarea name="meta_description" rows="2"
                              class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white resize-none"
                              placeholder="Short description for search results">{{ old('meta_description', $post?->meta_description) }}</textarea>
                </div>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-5">
            <div class="bg-white rounded-2xl border border-gray-100 p-6 space-y-4">
                <h3 class="font-bold text-gray-900 text-sm">Publish Settings</h3>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Status</label>
                    <select name="status" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white">
                        <option value="draft" {{ old('status', $post?->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $post?->status) === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Template</label>
                    <select name="template" class="w-full border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-emerald-400 bg-gray-50 focus:bg-white">
                        @foreach(['standard'=>'Standard Article','featured'=>'Featured Story','news'=>'News Update','guide'=>'How-to Guide'] as $val => $label)
                        <option value="{{ $val }}" {{ old('template', $post?->template ?? 'standard') === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Featured Image</label>
                    @if($post?->featured_image)
                        <img src="{{ asset('storage/'.$post->featured_image) }}" class="w-full h-28 object-cover rounded-lg mb-2">
                    @endif
                    <input type="file" name="featured_image" accept="image/*"
                           class="w-full text-xs text-gray-600 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:bg-emerald-50 file:text-emerald-700 file:font-semibold hover:file:bg-emerald-100 cursor-pointer">
                </div>

                <div class="pt-3 border-t border-gray-50 flex gap-3">
                    <button type="submit" class="flex-1 bg-emerald-600 text-white py-2.5 rounded-xl font-bold text-sm hover:bg-emerald-700 transition-colors">
                        {{ $post ? 'Update Post' : 'Create Post' }}
                    </button>
                    <a href="{{ route('admin.blog.index') }}" class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl font-semibold text-sm hover:bg-gray-50 transition-colors">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</form>

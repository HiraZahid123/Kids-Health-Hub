<?php

namespace App\Http\Controllers;

use App\Models\CommunityComment;
use App\Models\CommunityLike;
use App\Models\CommunityNotification;
use App\Models\CommunityPost;
use Illuminate\Http\Request;

class CommunityController extends Controller
{
    public function index(Request $request)
    {
        $query = CommunityPost::with('author')->withCount('allComments as comments_count');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%'.$request->search.'%')
                  ->orWhere('content', 'like', '%'.$request->search.'%');
            });
        }

        $posts = $query->orderByDesc('is_pinned')->latest()->paginate(15);
        $categories = CommunityPost::whereNotNull('category')->distinct()->pluck('category');

        $unreadCount = 0;
        if (auth()->check()) {
            $unreadCount = CommunityNotification::where('user_id', auth()->id())->unread()->count();
        }

        return view('community.index', compact('posts', 'categories', 'unreadCount'));
    }

    public function create()
    {
        return view('community.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string|min:10',
            'category' => 'nullable|string|max:100',
            'image'    => 'nullable|image|max:2048',
        ]);

        $data['user_id'] = auth()->id();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('community', 'public');
        }

        $post = CommunityPost::create($data);

        return redirect()->route('community.show', $post)->with('success', 'Post created!');
    }

    public function show(CommunityPost $post)
    {
        $post->load(['author', 'comments.author', 'comments.replies.author']);
        $likedPostIds = [];
        if (auth()->check()) {
            $likedPostIds = CommunityLike::where('user_id', auth()->id())
                ->where('likeable_type', CommunityPost::class)
                ->pluck('likeable_id')
                ->toArray();
        }
        return view('community.show', compact('post', 'likedPostIds'));
    }

    public function edit(CommunityPost $post)
    {
        abort_unless(auth()->id() === $post->user_id || auth()->user()->isAdmin(), 403);
        return view('community.edit', compact('post'));
    }

    public function update(Request $request, CommunityPost $post)
    {
        abort_unless(auth()->id() === $post->user_id || auth()->user()->isAdmin(), 403);

        $data = $request->validate([
            'title'    => 'required|string|max:255',
            'content'  => 'required|string|min:10',
            'category' => 'nullable|string|max:100',
        ]);

        $post->update($data);

        return redirect()->route('community.show', $post)->with('success', 'Post updated.');
    }

    public function destroy(CommunityPost $post)
    {
        abort_unless(auth()->id() === $post->user_id || auth()->user()->isAdmin(), 403);
        $post->delete();
        return redirect()->route('community.index')->with('success', 'Post deleted.');
    }

    public function storeComment(Request $request, CommunityPost $post)
    {
        $data = $request->validate([
            'content'   => 'required|string|min:2',
            'parent_id' => 'nullable|exists:community_comments,id',
        ]);

        abort_if($post->is_locked && !auth()->user()->isAdmin(), 403);

        $post->allComments()->create([
            'user_id'   => auth()->id(),
            'content'   => $data['content'],
            'parent_id' => $data['parent_id'] ?? null,
        ]);

        $post->increment('comments_count');

        if ($post->user_id !== auth()->id()) {
            CommunityNotification::create([
                'user_id'  => $post->user_id,
                'actor_id' => auth()->id(),
                'type'     => isset($data['parent_id']) ? 'comment_replied' : 'post_commented',
                'data'     => ['post_id' => $post->id, 'post_title' => $post->title],
            ]);
        }

        return back()->with('success', 'Comment added.');
    }

    public function destroyComment(CommunityComment $comment)
    {
        abort_unless(auth()->id() === $comment->user_id || auth()->user()->isAdmin(), 403);
        $comment->post->decrement('comments_count');
        $comment->delete();
        return back()->with('success', 'Comment deleted.');
    }

    public function toggleLike(CommunityPost $post)
    {
        $existing = CommunityLike::where('user_id', auth()->id())
            ->where('likeable_type', CommunityPost::class)
            ->where('likeable_id', $post->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $post->decrement('likes_count');
            $liked = false;
        } else {
            CommunityLike::create([
                'user_id'       => auth()->id(),
                'likeable_type' => CommunityPost::class,
                'likeable_id'   => $post->id,
            ]);
            $post->increment('likes_count');
            $liked = true;

            if ($post->user_id !== auth()->id()) {
                CommunityNotification::create([
                    'user_id'  => $post->user_id,
                    'actor_id' => auth()->id(),
                    'type'     => 'post_liked',
                    'data'     => ['post_id' => $post->id, 'post_title' => $post->title],
                ]);
            }
        }

        return response()->json(['liked' => $liked, 'count' => $post->fresh()->likes_count]);
    }

    public function notifications()
    {
        $notifications = CommunityNotification::where('user_id', auth()->id())
            ->with('actor')
            ->latest()
            ->paginate(20);

        CommunityNotification::where('user_id', auth()->id())->unread()->update(['read_at' => now()]);

        return view('community.notifications', compact('notifications'));
    }

    public function pinToggle(CommunityPost $post)
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        $post->update(['is_pinned' => !$post->is_pinned]);
        return back()->with('success', $post->is_pinned ? 'Post pinned.' : 'Post unpinned.');
    }

    public function lockToggle(CommunityPost $post)
    {
        abort_unless(auth()->user()->isAdmin(), 403);
        $post->update(['is_locked' => !$post->is_locked]);
        return back()->with('success', $post->is_locked ? 'Post locked.' : 'Post unlocked.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::published()->with('author')->latest('published_at')->paginate(12);
        return view('public.blog.index', compact('posts'));
    }

    public function show(BlogPost $post)
    {
        abort_unless($post->status === 'published', 404);
        $post->increment('views');
        $related = BlogPost::published()
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->limit(3)
            ->get();
        return view('public.blog.show', compact('post', 'related'));
    }
}

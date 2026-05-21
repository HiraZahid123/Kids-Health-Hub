<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityPost extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content', 'image', 'category',
        'likes_count', 'comments_count', 'is_pinned', 'is_locked',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'is_locked' => 'boolean',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(CommunityComment::class)->whereNull('parent_id')->with('replies.author', 'author')->latest();
    }

    public function allComments()
    {
        return $this->hasMany(CommunityComment::class);
    }

    public function likes()
    {
        return $this->morphMany(CommunityLike::class, 'likeable');
    }

    public function isLikedBy(?User $user): bool
    {
        if (!$user) return false;
        return $this->likes()->where('user_id', $user->id)->exists();
    }
}

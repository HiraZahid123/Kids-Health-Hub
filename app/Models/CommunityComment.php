<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityComment extends Model
{
    protected $fillable = ['community_post_id', 'user_id', 'parent_id', 'content'];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(CommunityPost::class, 'community_post_id');
    }

    public function replies()
    {
        return $this->hasMany(CommunityComment::class, 'parent_id')->with('author')->latest();
    }

    public function parent()
    {
        return $this->belongsTo(CommunityComment::class, 'parent_id');
    }

    public function likes()
    {
        return $this->morphMany(CommunityLike::class, 'likeable');
    }
}

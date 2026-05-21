<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityNotification extends Model
{
    protected $fillable = ['user_id', 'actor_id', 'type', 'data', 'read_at'];

    protected $casts = [
        'data'    => 'array',
        'read_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function actor()
    {
        return $this->belongsTo(User::class, 'actor_id');
    }

    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }
}

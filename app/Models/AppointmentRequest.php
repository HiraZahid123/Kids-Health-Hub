<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AppointmentRequest extends Model
{
    protected $fillable = [
        'family_user_id', 'provider_id', 'preferred_date',
        'notes', 'status', 'provider_message',
        'family_last_notified_at', 'provider_last_notified_at',
    ];

    protected $casts = [
        'preferred_date'            => 'date',
        'family_last_notified_at'   => 'datetime',
        'provider_last_notified_at' => 'datetime',
    ];

    public function family(): BelongsTo
    {
        return $this->belongsTo(User::class, 'family_user_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    public function isPending(): bool  { return $this->status === 'pending'; }
    public function isAccepted(): bool { return $this->status === 'accepted'; }
    public function isDeclined(): bool { return $this->status === 'declined'; }
}

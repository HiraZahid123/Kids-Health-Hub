<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    protected $fillable = [
        'provider_id', 'plan_type', 'status',
        'trial_ends_at', 'starts_at', 'ends_at', 'payment_status',
        'trial_warning_sent', 'stripe_customer_id', 'stripe_subscription_id',
    ];

    protected $casts = [
        'trial_ends_at'       => 'datetime',
        'starts_at'           => 'datetime',
        'ends_at'             => 'datetime',
        'trial_warning_sent'  => 'boolean',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }

    public function isActive(): bool
    {
        if ($this->status === 'trial') {
            return $this->trial_ends_at && $this->trial_ends_at->isFuture();
        }

        if ($this->status === 'active') {
            return $this->ends_at && $this->ends_at->isFuture();
        }

        return false;
    }
}

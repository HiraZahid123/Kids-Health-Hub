<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Provider extends Model
{
    protected $fillable = [
        'user_id', 'business_name', 'provider_name', 'slug',
        'phone', 'address', 'suburb', 'state', 'postcode',
        'latitude', 'longitude', 'bio', 'profile_image', 'website_url',
        'age_groups', 'funding_types', 'service_delivery',
        'telehealth_available', 'availability_status', 'wait_time',
        'approval_status', 'is_featured', 'is_active', 'admin_notes',
    ];

    protected $casts = [
        'age_groups'           => 'array',
        'funding_types'        => 'array',
        'service_delivery'     => 'array',
        'telehealth_available' => 'boolean',
        'availability_status'  => 'boolean',
        'is_featured'          => 'boolean',
        'is_active'            => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function subscription(): HasOne
    {
        return $this->hasOne(Subscription::class)->latestOfMany();
    }

    public function scopePubliclyVisible(Builder $query): Builder
    {
        return $query->where('approval_status', 'approved')
            ->where('is_active', true)
            ->whereHas('subscription', function (Builder $q) {
                $q->where(function ($inner) {
                    $inner->where('status', 'trial')
                        ->where('trial_ends_at', '>', now());
                })->orWhere(function ($inner) {
                    $inner->where('status', 'active')
                        ->where('ends_at', '>', now());
                });
            });
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeTelehealth(Builder $query): Builder
    {
        return $query->where('telehealth_available', true);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('availability_status', true);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function isPubliclyVisible(): bool
    {
        if ($this->approval_status !== 'approved' || ! $this->is_active) {
            return false;
        }

        return $this->subscription && $this->subscription->isActive();
    }
}

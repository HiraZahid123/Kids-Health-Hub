<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProviderView extends Model
{
    public $timestamps = false;

    protected $fillable = ['provider_id', 'ip_hash', 'viewed_at'];

    protected $casts = [
        'viewed_at' => 'datetime',
    ];

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class);
    }
}

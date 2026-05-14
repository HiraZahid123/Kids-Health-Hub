<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'is_active', 'sort_order'];

    public function providers(): BelongsToMany
    {
        return $this->belongsToMany(Provider::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExternalSource extends Model
{
    protected $fillable = [
        'name',
        'code',
        'base_url',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'source_id');
    }

    public function externalLogs(): HasMany
    {
        return $this->hasMany(ApiSyncLog::class, 'source_id');
    }
}

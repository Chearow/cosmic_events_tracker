<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventCache extends Model
{
    protected $fillable = [
        'source_id',
        'external_event_id',
        'raw_data',
    ];

    protected $casts = [
        'raw_data' => 'array',
        'fetched_at' => 'datetime',
    ];

    public function externalSource(): BelongsTo
    {
        return $this->belongsTo(ExternalSource::class, 'source_id');
    }
}

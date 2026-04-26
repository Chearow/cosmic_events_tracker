<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'event_type_id',
        'source_id',
        'external_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'peak_time',
        'severity',
        'link',
        'raw_data',
    ];

    protected $casts = [
        'event_type_id' => 'integer',
        'source_id' => 'integer',
        'external_id' => 'string',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'peak_time' => 'datetime',
        'raw_data' => 'array',
    ];

    public function eventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class, 'event_type_id');
    }

    public function externalSource(): BelongsTo
    {
        return $this->belongsTo(ExternalSource::class, 'source_id');
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(FavoriteEvent::class);
    }

    public function favoritedBy(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorite_events');
    }
}

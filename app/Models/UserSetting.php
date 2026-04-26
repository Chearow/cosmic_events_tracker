<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class UserSetting extends Model
{
    protected $fillable = [
        'theme',
        'items_per_page',
        'timezone',
        'language',
        'default_event_type_id',
        'default_source_id',
    ];

    protected $casts = [
        'items_per_page' => 'integer',
        'default_event_type_id' => 'integer',
        'default_source_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function defaultEventType(): BelongsTo
    {
        return $this->belongsTo(EventType::class, 'default_event_type_id');
    }

    public function defaultSource(): BelongsTo
    {
        return $this->belongsTo(ExternalSource::class, 'default_source_id');
    }
}

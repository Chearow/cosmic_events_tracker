<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ApiSyncLog extends Model
{
    protected $table = 'api_sync_logs';

    protected $fillable = [
        'source_id',
        'status',
        'message',
        'started_at',
        'finished_at',
        'raw_request',
        'raw_response',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'finished_at' => 'datetime',
        'raw_request' => 'array',
        'raw_response' => 'array',
    ];

    public function externalSource(): BelongsTo
    {
        return $this->belongsTo(ExternalSource::class, 'source_id');
    }
}

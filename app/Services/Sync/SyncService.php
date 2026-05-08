<?php

namespace App\Services\Sync;

use App\Models\ExternalSource;
use Illuminate\Support\Facades\Log;

class SyncService
{
    public function sync(ExternalSource $source)
    {
        Log::info("Синхронизация началась");
    }
}

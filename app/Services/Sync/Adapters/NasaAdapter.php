<?php

namespace App\Services\Sync\Adapters;

class NasaAdapter
{
    protected $apiUrl;

    public function __construct()
    {
        $this->apiUrl = config('services.nasa.url');
    }

    public function fetch(): array
    {
        return [];
    }
}

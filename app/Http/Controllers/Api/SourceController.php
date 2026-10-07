<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExternalSource;

class SourceController extends Controller
{
    public function index()
    {
        $externalSources = ExternalSource::all();

        return response()->json($externalSources);
    }
}

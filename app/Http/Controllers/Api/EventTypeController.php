<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EventType;

class EventTypeController extends Controller
{
    public function index()
    {
        $eventTypes = EventType::all();

        return response()->json($eventTypes);
    }
}

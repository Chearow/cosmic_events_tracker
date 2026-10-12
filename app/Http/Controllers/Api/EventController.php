<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::query()
            ->with(['eventType', 'externalSource'])
            ->when($request->filled('event_type_id'), function ($query) use ($request) {
                $query->where('event_type_id', $request->input('event_type_id'));
            })
            ->when($request->filled('source_id'), function ($query) use($request) {
                $query->where('source_id', $request->input('source_id'));
            })
            ->when($request->input('search'), function ($query, $search) {
                $query->where('title', 'like', "%{$search}%");
            })
            ->orderBy('start_time', 'desc')
            ->paginate(15);

        return response()->json($events);
    }

    public function show(Event $event)
    {
        $event->load(['eventType', 'externalSource']);

        return response()->json([
            'event' => $event,
            'event_type' => $event->eventType,
            'source' => $event->externalSource,
        ]);
    }
}

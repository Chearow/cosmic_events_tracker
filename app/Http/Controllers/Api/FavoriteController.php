<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\FavoriteEvent;

class FavoriteController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $favorites = $user->favorites()
            ->with(['eventType', 'source'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

    return response()->json(['favorites' => $favorites], 200);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id;
        $event_id = $request->event_id;

        if (! $event_id) {
            return response()->json(['message' => 'Bad Request'], 400);
        }

        $exists = Event::where('id', $event_id)->exists();

        if (! $exists) {
            return response()->json(['message' => 'Event not found'], 404);

        }

        $favorite = FavoriteEvent::where([
            'user_id' => $user_id,
            'event_id' => $event_id
        ])->exists();

        if ($favorite) {
            return response()->json(['message' => 'This event already exists'], 409);
        }

        $add_favorite = FavoriteEvent::create([
            'user_id' => $user_id,
            'event_id' => $event_id
        ]);

        return response()->json(['message' => 'Added to favorites'], 200);
    }

    public function destroy(Request $request)
    {
        $user = $request->user();
        $user_id = $user->id;
        $event_id = $request->event_id;

        if (! $event_id) {
            return response()->json(['message' => 'Bad Request'], 400);
        }

        $exists = Event::where('id', $event_id)->exists();

        if (! $exists) {
            return response()->json(['message' => 'Event not found'], 404);
        }

        $favorite = FavoriteEvent::where([
            'user_id' => $user_id,
            'event_id' => $event_id
        ])->first();

        if (! $favorite) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }

       $favorite->delete();

        return response()->json(['message' => 'Removed from favorites'], 200);
    }
}

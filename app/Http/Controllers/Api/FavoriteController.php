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
        $favorites = $request->user()
            ->favorites()
            ->with(['eventType', 'externalSource'])
            ->orderByPivot('created_at', 'desc')
            ->paginate(15);

    return response()->json(['favorites' => $favorites], 200);
    }

    public function store(Request $request, Event $event)
    {
        $user = $request->user();

        if ($user->favorites()->whereKey($event->id)->exists()) {
            return response()->json(['message' => 'This event already exists'], 409);
        }

        $user->favorites()->attach($event->id);

        return response()->json(['message' => 'Event added to favorites'], 201);
    }

    public function destroy(Request $request, Event $event)
    {
        $user = $request->user();

        $deleted = $user->favorites()->detach($event->id);

        if ($deleted === 0) {
            return response()->json(['message' => 'Favorite not found'], 404);
        }
        return response()->json(['message' => 'Event deleted from favorites']);
    }
}

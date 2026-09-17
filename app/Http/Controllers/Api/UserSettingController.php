<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserSettingController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();
        $user_setting = $user->userSetting;

        if (! $user_setting) {
            return response()->json([]);
        }

        return response()->json($user_setting->toArray());
    }

    public function update(Request $request): JsonResponse
    {
        $user = $request->user();

        $validated = $request->validate([
            'theme' => ['required', 'string'],
            'items_per_page' => ['required','integer'],
            'timezone' => ['required', 'string'],
            'language' => ['required', 'string'],
            'default_event_type_id' => ['nullable', 'integer', 'exists:event_types,id'],
            'default_source_id' => ['nullable', 'integer', 'exists:external_sources,id'],
        ]);

        $userSetting = $user->userSetting()->updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return response()->json($userSetting->toArray());
    }
}

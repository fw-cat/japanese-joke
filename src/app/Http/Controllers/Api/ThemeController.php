<?php

namespace App\Http\Controllers\Api;

use App\Enums\PostStatus;
use App\Enums\ThemeStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Http\Resources\ThemeResource;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ThemeController extends Controller
{
    public function index(): JsonResponse
    {
        $themes = Theme::where([
            'status' => ThemeStatus::ACTIVE,
        ])->get();

        return new JsonResponse([
            'themes' => ThemeResource::collection($themes),
        ], Response::HTTP_OK);
    }

    public function show(Theme $theme): JsonResponse
    {
        return new JsonResponse([
            'theme' => new ThemeResource($theme),
            'posts' => PostResource::collection($theme->posts()->checked()->get()),
        ], Response::HTTP_OK);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Enums\ThemeStatus;
use App\Http\Controllers\Controller;
use App\Http\Resources\ThemeResource;
use App\Models\Theme;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ThemeController extends Controller
{
    /**
     * TODO: 可能ならChatGPT APIを利用してランダム生成する
     */
    public function index(): JsonResponse
    {
        $themes = Theme::where([
            'status' => ThemeStatus::ACTIVE,
        ])->get();

        return new JsonResponse([
            'themes' => ThemeResource::collection($themes),
        ], Response::HTTP_OK);
    }

}

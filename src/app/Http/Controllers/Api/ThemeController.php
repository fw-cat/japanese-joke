<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return new JsonResponse([
            'くつ', 'さくらんぼ', 'かさ', 'いぬ', 'たまご',
            'ゴールデンウィーク',  '五月晴れ', '五月病', 'こいのぼり', '梅雨前の晴れ',
        ], Response::HTTP_OK);
    }

}

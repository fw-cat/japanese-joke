<?php

namespace App\Services;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

abstract class OpenAIService extends Service
{
    /**
     * Prompt設定
     */
    protected array $prompts;

    public function setPrompts(array $prompts): void
    {
        $this->prompts = $prompts;
    }

    /**
     * リクエストを送信する
     */
    abstract public function sendRequest(): mixed;

    /**
     * メイン処理はリクエストを送信するだけ
     */
    public function main(Request $request): mixed
    {
        return $this->sendRequest($this->prompts);
    }
}

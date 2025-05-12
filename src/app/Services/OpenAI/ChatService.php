<?php

namespace App\Services\OpenAI;

use App\Services\OpenAIService;
use Illuminate\Http\Request;

class ChatService extends OpenAIService
{
    /**
     * Prompt設定
     */
    private array $prompts;

    public function setPrompts(array $prompts): void
    {
        $this->prompts = $prompts;
    }

    public function main(Request $request): mixed
    {
        return $this->sendRequest($this->prompts);
    }
}

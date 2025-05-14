<?php

namespace App\Services\OpenAI;

use App\Services\OpenAIService;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatService extends OpenAIService
{
    public function sendRequest(): string|null
    {
        try {
            $chat = OpenAI::chat()->create([
                'model' => $this->prompts['model'],
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $this->prompts['prompt'],
                    ],
                ],
            ]);
            return $chat->choices[0]->message->content;

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }
}

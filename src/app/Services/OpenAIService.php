<?php

namespace App\Services;

use OpenAI\Laravel\Facades\OpenAI;

abstract class OpenAIService extends Service
{

    public function sendRequest(array $prompt): string|null
    {
        try {
            $chat = OpenAI::chat()->create([
                'model' => $prompt['model'],
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt['prompt'],
                    ],
                ],
            ]);
            $this->logger->debug(print_r([
                'caht' => $chat,
                'message' => $chat->choices[0]->message,
            ], true));

            return $chat->choices[0]->message->content;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }
}

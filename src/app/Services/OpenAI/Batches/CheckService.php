<?php

namespace App\Services\OpenAI\Batches;

use App\Enums\OpenAI\BatchStatus;
use App\Services\OpenAIService;
use OpenAI\Laravel\Facades\OpenAI;

class CheckService extends OpenAIService
{

    public function sendRequest(array $prompt = []): array|null
    {
        try {
            $response = OpenAI::batches()->retrieve($prompt['batche_id']);
            $this->logger->debug(print_r([
                'response' => $response,
            ], true));

            if ($response->status === 'failed') {
                // バッチが失敗した場合
                return [ BatchStatus::FAILED, $response, null, null];
            }

            if ($response->status === 'completed') {
                // バッチが完了した場合
                return [ BatchStatus::COMPLETED, $response, $response->inputFileId, $response->outputFileId ];
            }
            return [null, null, null, null];

        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return [null, null, null, null];
        }
    }
}

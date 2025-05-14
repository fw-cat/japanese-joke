<?php

namespace App\Services\OpenAI\Batches;

use App\Services\OpenAIService;
use OpenAI\Laravel\Facades\OpenAI;

class DownloadService extends OpenAIService
{
    public function sendRequest(array $params = []): string|null
    {
        try {
            $response = OpenAI::files()->download($params['output_file_id']);

            $this->logger->debug(print_r([
                'response' => $response,
            ], true));

            // ファイルのダウンロードが完了した場合はinput_file_idとoutput_file_idを削除
            OpenAI::files()->delete($params['input_file_id']);
            OpenAI::files()->delete($params['output_file_id']);

            return $response;
        } catch (\Exception $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }
}

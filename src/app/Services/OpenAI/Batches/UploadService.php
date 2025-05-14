<?php

namespace App\Services\OpenAI\Batches;

use App\Enums\OpenAI\BatchStatus;
use App\Models\OpenaiBatchLog;
use App\Services\OpenAIService;
use CURLFile;
use CURLStringFile;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use OpenAI\Exceptions\ErrorException;
use OpenAI\Laravel\Facades\OpenAI;
use Symfony\Component\HttpFoundation\File\Stream;

class UploadService extends OpenAIService
{
    private const FILE_PATH = 'batch.jsonl';

    /**
     * バッチ送信用データ
     */
    private array $datas;

    public function setSendData(array $datas): void
    {
        $this->datas = $datas;
    }


    public function sendRequest(): string|null
    {
        try {
            // sendDataをJSONLファイルに保存
            $lines = [];
            foreach($this->datas as $data) {
                $lines[] = json_encode($data);
            }
            $sendFile = Storage::disk('local')->put(self::FILE_PATH, implode(PHP_EOL, $lines));
            $this->logger->debug(print_r([
                'send file ' => $sendFile,
                'storage_path' => Storage::disk('local')->path(self::FILE_PATH),
            ], true));

            // 解析用JSONファイルをアップロード
            // OpenAI::files()->upload()ではなく、CURLでアップロード
            $curl = curl_init();
            $headers = [
                'Authorization: Bearer ' . env('OPENAI_API_KEY'),
                'Content-Type: multipart/form-data',
            ];
            $post_fields = [
                'purpose' => 'batch',
                'file' => new CURLFile(Storage::disk('local')->path(self::FILE_PATH), self::FILE_PATH),
            ];
            curl_setopt($curl, CURLOPT_URL, 'https://api.openai.com/v1/files');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields);
            $response = curl_exec($curl);
            $response = json_decode($response, true);
            curl_close($curl);

            // responceのチェック
            if (isset($response['error'])) {
                // エラーハンドリング
                throw new Exception($response['error']['message']);
            }

            // file_idを取得
            $file_id = $response['id'];
            $batches = OpenAI::batches()->create([
                "input_file_id" => $file_id,
                "endpoint" => "/v1/chat/completions",
                "completion_window" => "24h"
            ]);
            $this->logger->debug(print_r([
                $batches,
            ], true));

            $log = new OpenaiBatchLog();
            $log->batche_id = $batches->id;
            $log->status = BatchStatus::REGISTERD->value;
            $log->upload_result = json_encode($response);
            $log->save();

            return "";

        } catch (ErrorException $e) {
            $this->logger->error($e->getMessage());
            return null;
        }
    }}

<?php

namespace App\Console\Commands;

use App\Enums\OpenAI\BatchStatus;
use App\Enums\PostStatus;
use App\Models\OpenaiBatchLog;
use App\Models\Post;
use App\Services\OpenAI\Batches\CheckService;
use App\Services\OpenAI\Batches\DownloadService;
use Illuminate\Console\Command;

class CheckPostResults extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'j-joke:check-post-results';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download and Check OpenAI BatchsAPI result file';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // BatchIDを取得
        $batches = OpenaiBatchLog::where([
            ['status', BatchStatus::REGISTERD->value],
        ])->get();

        $service = new CheckService();
        foreach ($batches as $batch) {
            list($status, $result, $input_file_id, $output_file_id) = $service->sendRequest([
                'batche_id' => $batch->batche_id,
            ]);
            if (empty($status)) {
                // バッチが完了していない場合、次のバッチへ
                continue;
            }

            $batch->status = $status;
            $batch->checked_result = $result;

            if ($batch->status->isComplated()) {
                // バッチが完了した場合、続けてDownloadServiceを実行
                $service = new DownloadService();
                $result = $service->sendRequest([
                    'input_file_id'  => $input_file_id,
                    'output_file_id' => $output_file_id,
                ]);
                if (empty($result)) {
                    // ファイルがダウンロードできない場合、次のバッチへ
                    continue;
                }
                // Downlload情報で保存
                $batch->status = BatchStatus::DOWNLOADED;
                $batch->download_result = $result;
                $batch->save();

                // download結果を解析
                $lines = explode("\n", $result);
                // JSONL形式
                foreach ($lines as $line) {
                    if (empty($line)) {
                        continue;
                    }

                    $json = json_decode($line, true);
                    // PostsIDを取得
                    $post_id = $json['custom_id'];
                    $post_id = str_replace('check-joke-', '', $post_id);
                    $post_id = (int)$post_id;

                    $responce_body = $json['response']['body'];
                    $content = $responce_body['choices'][0]['message']['content'];
                    if ($content === 'yes') {
                        Post::where('id', $post_id)->update([
                            'status' => PostStatus::NICE_JOKE,
                        ])->save();
                    } else {
                        Post::where('id', $post_id)->update([
                            'status' => PostStatus::NOT_JOKE,
                        ])->save();
                    }
                }
            }

            // チェック結果で更新
            $batch->save();
        }


        // BatchIDを取得
        echo "Checked Batches Response! Please check your Database." . PHP_EOL;
        exit();
    }
}

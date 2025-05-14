<?php

namespace App\Console\Commands;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Services\OpenAI\Batches\UploadService;
use Illuminate\Console\Command;

class UploadPostss extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'j-joke:upload-postss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send to OpenAI BatchsAPI.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 登録済のPostsを取得
        $posts = Post::where('status', PostStatus::REGISTERED)->get();


        // バッチ送信用データに整形
        $posts = $posts->map(function ($post) {
            $prompts = config('openai.prompts.check_joke');

            $content = sprintf($prompts['prompt'], $post->theme->content, $post->content);
            return [
                "custom_id" => sprintf('check-joke-%d', $post->id),
                "method" => "POST",
                "url" => "/v1/chat/completions",
                "body" => [
                    "model" => $prompts['model'],
                    "messages" => [
                        ["role" => "system", "content" => "You are a helpful assistant."],
                        ["role" => "user", "content" => $content],
                    ]
                ]
            ];
        });

        $service = new UploadService();
        $service->setSendData($posts->toArray());
        $service->sendRequest([]);

        echo "Upload Post's Finished! Wating for BatchesAPI Complate." . PHP_EOL;
        exit();
    }
}

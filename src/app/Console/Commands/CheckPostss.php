<?php

namespace App\Console\Commands;

use App\Enums\PostStatus;
use App\Models\Post;
use Illuminate\Console\Command;

class CheckPostss extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'j-joke:check-postss';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check joke is theme posts';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 登録済のPostsを取得
        $posts = Post::where('status', PostStatus::REGISTERED)->get();
    }
}

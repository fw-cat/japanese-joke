<?php

namespace App\Console\Commands;

use App\Enums\ThemeStatus;
use App\Models\Theme;
use Illuminate\Console\Command;

class CreateThemes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-themes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create new themes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // TODO: ChatGPT等からデータを生成する
        $themes = [
            'くつ', 'さくらんぼ', 'かさ', 'いぬ', 'たまご',
            'ゴールデンウィーク',  '五月晴れ', '五月病', 'こいのぼり', '梅雨前の晴れ',
        ];

        // 現在のThemeをINACTIVE化
        Theme::where([
            'status' => ThemeStatus::ACTIVE,
        ])->update([
            'status' => ThemeStatus::INACTIVE
        ]);

        // 取得したThemeを登録
        foreach ($themes as $theme) {
            // 同じコンテンツがある場合は上書き 
            Theme::updateOrCreate(
                ['content' => $theme],
                ['status' => ThemeStatus::ACTIVE]
            );
        }

        echo "Created Teheme's Finished! Please check your Database." . PHP_EOL;
        exit();
    }
}

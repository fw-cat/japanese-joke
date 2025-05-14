<?php

namespace App\Console\Commands;

use App\Enums\ThemeStatus;
use App\Models\Theme;
use App\Services\OpenAI\ChatService;
use App\Services\OpenAIService;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CreateThemes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'j-joke:create-themes';

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
        // Serviceの初期化
        $service = new ChatService();
        $prompts = config('openai.prompts.create_theme');
        $prompts['prompt'] = sprintf($prompts['prompt'], Carbon::now()->format('Y年m月d日'));
        $service->setPrompts($prompts);
        $themes = $service->sendRequest();
        $themes = json_decode($themes, true);

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
                ['content' => $theme['theme']],
                ['status' => ThemeStatus::ACTIVE]
            );
        }

        echo "Created Teheme's Finished! Please check your Database." . PHP_EOL;
        exit();
    }
}

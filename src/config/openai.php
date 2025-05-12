<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OpenAI API Key and Organization
    |--------------------------------------------------------------------------
    |
    | Here you may specify your OpenAI API Key and organization. This will be
    | used to authenticate with the OpenAI API - you can find your API key
    | and organization on your OpenAI dashboard, at https://openai.com.
    */

    'api_key' => env('OPENAI_API_KEY'),
    'organization' => env('OPENAI_ORGANIZATION'),

    /*
    |--------------------------------------------------------------------------
    | Request Timeout
    |--------------------------------------------------------------------------
    |
    | The timeout may be used to specify the maximum number of seconds to wait
    | for a response. By default, the client will time out after 30 seconds.
    */

    'request_timeout' => env('OPENAI_REQUEST_TIMEOUT', 30),

    /**
     * 各種Prompt
     */
    'prompts' => [
        /**
         * だじゃれのチェックを行う
         */
        'check_joke' => [
            'prompt' => '%s

上記の文章がだじゃれと成立していまるかチェックしてください。
返答はJSONの文字列のみを返すようにしてください。
返答のJSONのフォーマットは以下の通りです。

{
    "result": "true"
}
resultの値はtrueかfalseのみを返すようにしてください。',
            'model' => 'gpt-3.5-turbo',
        ],

        /**
         * だじゃれのお題を作成する
         */
        'create_theme' => [
            'prompt' => 'ダジャレを投稿してもらいます。
ダジャレのお題になる単一語を考えてください。

今日の日付は%sです。
日付に沿うようなお題を考えてください。
お題は単一語で10個お願いします。

回答はJSONの文字列のみを返すようにしてください。
返答のJSONのフォーマットは以下の通りです。

[
    {
        "theme": "お題1"
    },
    {
        "theme": "お題2"
    }, 
]',
            'model' => 'gpt-4.1',
        ],
    ]
];

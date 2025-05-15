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
            'prompt' => '
# 解析対象のデータ
お題：%s
だじゃれ：%s

# チェック条件
・お題に沿ったダジャレである
・性的表現が使用されていない
・差別的表現が使用されていない

## ダジャレとは
駄洒落（だじゃれ）とは、同じ或いは非常に似通った音を持つ言葉をかけて遊ぶ一種の言葉遊びです。  
原則としては、 以下の3つです。  
* 同音異義語を使う。 
* なるべく短く簡単に言う。 
* 意味をつけずナンセンスに。

### ダジャレの例
#### 同じ読みを持つ語を用いたもの
* トイレにいっ__といれ__
* 電話に__でんわ__
* 猫が__ねこ__ろんだ

#### 似たような音を持つ語を用いたもの
* [こうちょう]（校長）先生絶[こうちょう]（好調）
* [ふとん](布団)が[ふっとん](吹っ飛ん)だ
* アルミ缶の上に__あるミカン__

#### 二つの語を融合したもの
* 「[ふとん](布団)が[おやま](お山)の方まで[ふっとん](吹っ飛ん)だ」「布団がお山の方まで吹っ飛んだ!」「(おやま)[おやま]ぁ」

#### 日本語を外国語に置き換えたもの（またはその逆）
* 本がブックブックと沈む
  * 副詞『ぶくぶく』と、本を英語にした「ブック」（book）を掛けている


# 返答に関する条件
すべての条件に合致している場合は「yes」
どれか一つでも条件に合致していない場合は「no」
返答は「yes」か「no」の文字列のみを返すようにしてください。',
            'model' => 'gpt-4o-mini',
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

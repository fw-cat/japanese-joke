<?php

namespace App\Services\Post;

use App\Enums\PostStatus;
use App\Models\Post;
use App\Models\Theme;
use App\Services\Service;
use Exception;
use Illuminate\Http\Request;

class StoreService extends Service
{
    public function main(Request $request): mixed
    {
        try {
            $post = new Post();
            $post->fill($request->only($post->getFillable()));
            $post->user_name = $request->input("uuser_name") ?? Post::DEFAULT_USER_NAME;
            $post->status    = PostStatus::REGISTERED;

            $theme = Theme::find($request->input("theme_id"));
            $theme->posts()->save($post);
            return $post;

        } catch(Exception $e) {
            $this->alert($e->getMessage());
            throw new Exception("新規登録に失敗しました");
        }
    }
}

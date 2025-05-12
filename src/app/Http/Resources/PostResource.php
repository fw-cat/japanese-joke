<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'theme_id' => $this->theme_id,
            'content' => $this->content,
            'author_name' => $this->author_name,
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}

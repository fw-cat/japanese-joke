<?php

namespace App\Models;

use App\Enums\PostStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public const DEFAULT_USER_NAME = "no name";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'theme_id',
        'content',
    ];

    /**
     * お題
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Theme>
     */
    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * チェック済みの投稿のみを取得するスコープ
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeChecked($query)
    {
        return $query->where('status', PostStatus::NICE_JOKE);
    }
}

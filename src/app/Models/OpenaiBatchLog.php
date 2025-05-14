<?php

namespace App\Models;

use App\Enums\OpenAI\BatchStatus;
use Illuminate\Database\Eloquent\Model;

class OpenaiBatchLog extends Model
{
    protected $fillable = [
        'batche_id',
        'status',
    ];

    protected $casts = [
        'status' => BatchStatus::class,
        'upload_result' => 'array',
        'checked_result' => 'array',
        'download_result' => 'array',
    ];
}

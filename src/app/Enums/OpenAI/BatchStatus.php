<?php

namespace App\Enums\OpenAI;

enum BatchStatus: int
{
    case REGISTERD  = 0;
    case COMPLETED  = 10;
    case DOWNLOADED = 20;
    case FAILED     = 99;

    public function isComplated(): bool
    {
        return self::COMPLETED->value === $this->value;
    }
}

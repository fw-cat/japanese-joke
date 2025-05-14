<?php

namespace App\Enums;

enum PostStatus: int
{
    case REGISTERED = 1;
    case IS_CHECKED = 10;
    case NICE_JOKE  = 11;
    case NOT_JOKE   = 12;
    case DELETED    = 99;
}

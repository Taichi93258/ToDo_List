<?php

namespace App\Enums;

enum Priority: int
{
    case low = 1;
    case middle = 2;
    case high = 3;

    public function label(): string
    {
        return match ($this) {
            Priority::low => '低',
            Priority::middle => '中',
            Priority::high => '高',
        };
    }
}

enum Release: int
{
    case public = 1;
    case private = 0;

    public function label(): string
    {
        return match ($this) {
            Release::public => '公開',
            Release::private => '非公開',
        };
    }
}

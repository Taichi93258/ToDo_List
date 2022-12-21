<?php

namespace App\Enums;

enum Priority: int
{
    case LOW = 1;
    case MIDDLE = 2;
    case HIGH = 3;

    public function label(): string
    {
        return match ($this) {
            Priority::LOW => '低',
            Priority::MIDDLE => '中',
            Priority::HIGH => '高',
        };
    }
}
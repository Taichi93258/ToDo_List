<?php

namespace App\Enums;

enum Release: int
{
    case PRIVATE = 0;
    case PUBLIC = 1;


    public function label(): string
    {
        return match ($this) {
            Release::PRIVATE => '非公開',
            Release::PUBLIC => '公開',
        };
    }
}
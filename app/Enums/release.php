<?php

namespace App\Enums;

enum Release: int
{
    case private = 0;
    case public = 1;


    public function label(): string
    {
        return match ($this) {
            Release::private => '非公開',
            Release::public => '公開',
        };
    }
}

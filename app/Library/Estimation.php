<?php

namespace App\Library;

use Illuminate\Support\Facades\Facade;

class Estimation extends Facade
{
    public static function estimate($posts)
    {
        $estimate_hour_sum = 0;
        foreach ($posts as $post) {
            $estimate_hour_sum += $post->estimate_hour;
        }
        return $estimate_hour_sum;
    }
}
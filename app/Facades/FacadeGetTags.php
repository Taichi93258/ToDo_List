<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FacadeGetTags extends Facade
{
    protected static function getFacadeAccessor()
    {
        // Facade化したいクラスのクラス名を書く
        return 'GetTags';
    }
}

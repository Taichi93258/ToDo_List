<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FacadeEstimation extends Facade // 【1行目】ここのクラス名と
{
    protected static function getFacadeAccessor()
    {
        // Facade化したいクラスのクラス名を書く
        return 'Estimation';
    }
}
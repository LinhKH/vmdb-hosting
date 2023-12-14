<?php

namespace App\Http\Traits;

use App\Observers\BaseObserver;

trait ObservantTrait
{
    public static function bootObservantTrait()
    {
        static::observe(new BaseObserver);
    }
}
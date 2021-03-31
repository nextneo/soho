<?php

namespace App\Traits;

use App\Observers\AuthorObserver;

/**
 * 更新者オブサーバートレイト
 * 
 */
trait AuthorObservable
{
    public static function bootAuthorObservable()
    {
        self::observe(AuthorObserver::class);
    }
}

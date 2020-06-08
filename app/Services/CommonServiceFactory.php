<?php

namespace App\Services;

use App\Services\Impl\LinkService;

class CommonServiceFactory
{
    protected static $mLinkService;

    public static function mLinkService()
    {
        if (self::$mLinkService == null) {
            self::$mLinkService = new LinkService();
        }
        return self::$mLinkService;
    }
}

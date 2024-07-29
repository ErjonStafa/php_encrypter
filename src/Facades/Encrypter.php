<?php

namespace Erjon\PhpEncrypter\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void proceed($files)
 */
class Encrypter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Encrypter';
    }
}

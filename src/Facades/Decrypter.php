<?php

namespace Erjon\PhpEncrypter\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static mixed proceed($phpFile)
 */
class Decrypter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Decrypter';
    }
}

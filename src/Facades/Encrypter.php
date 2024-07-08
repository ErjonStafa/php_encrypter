<?php

namespace Erjon\PhpEncrypter\Facades;

use Illuminate\Support\Facades\Facade;

class Encrypter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Encrypter';
    }
}

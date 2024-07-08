<?php

namespace Erjon\PhpEncrypter\Facades;

use Illuminate\Support\Facades\Facade;

class Decrypter extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'Decrypter';
    }
}

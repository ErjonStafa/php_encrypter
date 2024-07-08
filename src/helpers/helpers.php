<?php

if (! function_exists('erjon_decrypt')) {
    function erjon_decrypt($phpFile)
    {
        return \Erjon\PhpEncrypter\Facades\Decrypter::proceed($phpFile);
    }
}

if(! function_exists('get_os')){
    function get_os()
    {
        return php_uname();
    }
}
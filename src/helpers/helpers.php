<?php

if (! function_exists('erjon_decrypt')) {
    function erjon_decrypt($phpFile)
    {
        return \Erjon\PhpEncrypter\Facades\Decrypter::proceed($phpFile);
    }
}

<?php


if (! function_exists('erjon_decrypt')) {
    function erjon_decrypt($phpFile)
    {
        return \Erjon\PhpEncrypter\Support\Decrypter::proceed($phpFile);
    }
}

if(! function_exists('get_os')){
    /**
     * Return linux or windows
     *
     * @return string
     */
    function get_os()
    {
        $os = php_uname();

        if (preg_match('/Linux/', $os)){
            return 'Linux';
        }

        return 'Windows';
    }
}

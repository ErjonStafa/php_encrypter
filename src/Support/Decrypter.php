<?php

namespace Erjon\PhpEncrypter\Support;

class Decrypter
{
    const Decryption_Script = "return erjon_decrypt(__FILE__);\n";

    private static $iv;

    private static $encryptionMethod = 'AES-256-CBC';

    private static $options = 0;

    public static function proceed($phpFile)
    {
        $fileNameLength = strlen($phpFile);
        self::$iv = substr($phpFile, $fileNameLength - 16 ,$fileNameLength - 1);
        return eval(self::decode(file_get_contents($phpFile)));
    }

    private static function getContentToDecode($fileContents)
    {
        return substr(self::getContentParts($fileContents)[2], 1);
    }

    private static function getRegularCode($fileContents)
    {
        $fileContents = preg_replace('/\r/','' ,$fileContents);
        return preg_split("/(<\?php\n)/" ,self::getContentParts($fileContents)[0])[1];
    }

    private static function getContentParts($fileContents)
    {
        return preg_split('/('. self::replaceSomeChars(self::Decryption_Script) .')+/', $fileContents, -1, 2);
    }

    private static function replaceSomeChars($string)
    {
        $string = str_replace(';', '\;', $string);
        $string = str_replace('(', '\(', $string);
        return str_replace(')', '\)', $string);
    }

    private static function decode($fileContents)
    {
        return self::getRegularCode($fileContents)
            . openssl_decrypt(self::getContentToDecode($fileContents), self::$encryptionMethod, self::getKey(), self::$options, self::$iv);
    }

    private static function getKey()
    {
        if(get_os() == 'Linux') {
            exec('cd ' . __DIR__ . ' && chmod +x key && ./key', $out);
        } else {
            exec('cd ' . __DIR__ . ' && key', $out);
        }

        return $out[0];
    }
}

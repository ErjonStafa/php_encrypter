<?php

namespace Erjon\PhpEncrypter\Support;

use function Laravel\Prompts\select;

class Original
{
    const Decryption_Script = "return erjon_decrypt(__FILE__);\n";

    private static $iv;

    private static $encryptionMethod = 'AES-256-CBC';

    private static $options = 0;

    public static function restore($phpFile, $key)
    {
        $fileNameLength = strlen($phpFile);
        self::$iv = substr($phpFile, $fileNameLength - 16 ,$fileNameLength - 1);
        return file_put_contents($phpFile, self::decode(file_get_contents($phpFile), $key));
    }

    private static function getContentToDecode($fileContents)
    {
        return substr(self::getContentParts($fileContents)[2], 1);
    }

    private static function getRegularCode($fileContents)
    {
        $fileContents = preg_replace('/\r/','' ,$fileContents);
        return self::getContentParts($fileContents)[0];
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

    private static function decode($fileContents, $key)
    {
        return self::getRegularCode($fileContents)
            . openssl_decrypt(self::getContentToDecode($fileContents), self::$encryptionMethod, $key, self::$options, self::$iv);
    }
}

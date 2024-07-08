<?php

namespace Erjon\PhpEncrypter\Support;

final class EncrypterFacade
{
    public const Decryption_Script = "return erjon_decrypt(__FILE__);\n";

    private static string $iv;

    private static string $encryptionMethod = 'AES-256-CBC';

    private static int $options = 0;

    public static function proceed($phpFile): void
    {
        $fileNameLength = strlen($phpFile);
        self::$iv = substr($phpFile, $fileNameLength - 16 ,$fileNameLength - 1);
        $fileContents = self::addDecryptionScript(self::getFileContents($phpFile));
        file_put_contents($phpFile, $fileContents);
    }

    private static function getFileContents($phpFile)
    {
        $contents = file_get_contents($phpFile);
        return preg_replace('/\r/', '', $contents);
    }

    private static function addDecryptionScript($fileContents): string
    {
        if (self::hasNameSpace($fileContents)) {
            $string = preg_split("/(<\?php\n)(\nnamespace (\S+)\n)/", $fileContents, -1, 2);
            return $string[1]
                . $string[2]
                . self::Decryption_Script
                . '#' .openssl_encrypt($string[4], self::$encryptionMethod, self::getKey(), self::$options, self::$iv);
        }

        $string = preg_split("/(<\?php\n)/", $fileContents, -1, 2);
        return $string[1]
            . self::Decryption_Script
            . '#' .openssl_encrypt($string[2], self::$encryptionMethod, self::getKey(), self::$options, self::$iv);
    }



    private static function hasNameSpace($fileContents): bool
    {
        return preg_match("/(<\?php\n)(\nnamespace (\S+)\n)/", $fileContents);
    }

    private static function getKey(): string
    {
        if(get_os() == 'Linux') {
            exec('cd ' . __DIR__ . ' && ./key', $out);
        } else {
            exec('cd ' . __DIR__ . ' && key', $out);
        }

        return $out[0];
    }
}

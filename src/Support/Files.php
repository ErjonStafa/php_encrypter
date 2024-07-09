<?php

namespace Erjon\PhpEncrypter\Support;

class Files
{
    public static function get(string $directory)
    {
        $directory = base_path($directory);
        $dir  = new \RecursiveDirectoryIterator($directory);
        $flat  = new \RecursiveIteratorIterator($dir);
        $files = new \RegexIterator($flat, '/\.php$/i');
        $files = self::removeKernelCommand($files);
        return $files;
    }

    private static function removeKernelCommand($files)
    {
        $copyFiles = [];
        foreach ($files as $file) {
            if (! preg_match('/app\/Console\/Kernel\.php$/', $file)) {
                $copyFiles[] = $file;
            }
        }
        return $copyFiles;
    }
}

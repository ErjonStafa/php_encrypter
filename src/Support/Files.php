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
        return self::removeKernelCommand($files);
    }

    private static function removeKernelCommand(\RegexIterator $files): array
    {
        $copyFiles = [];
        $configPaths = self::configRealPath();

        foreach ($files as $file) {
            if (! in_array($file->getRealPath(), $configPaths)) {
                $copyFiles[] = $file;
            }
        }

        return $copyFiles;
    }

    private static function configRealPath(): array
    {
        $files = config('erjon_encrypter.excluded_files', []);

        return array_map(function ($item) {
            return base_path($item);
        }, $files);
    }
}

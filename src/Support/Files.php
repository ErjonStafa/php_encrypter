<?php

namespace Erjon\PhpEncrypter\Support;

class Files
{
    public static function get(): array
    {
        $paths = self::configPaths();
        $files = [];
        foreach ($paths as $path) {
            $files = array_merge($files, self::getFolderPhpFiles($path));
        }
        return self::includeUniqueFiles($files);
    }

    private static function getFolderPhpFiles(string $directory): array
    {
        $dir  = new \RecursiveDirectoryIterator($directory);
        $flat  = new \RecursiveIteratorIterator($dir);
        $files = new \RegexIterator($flat, '/\.php$/i');
        return self::removeExcludedFiles($files);
    }

    private static function includeUniqueFiles(array $files): array
    {
        $uniqueFiles = self::configUniqueFilesPath();

        return array_unique(array_merge($files, $uniqueFiles));
    }

    private static function removeExcludedFiles(\RegexIterator $files): array
    {
        $copyFiles = [];
        $configExcludedRealPath = self::configExcludedRealPath();

        foreach ($files as $file) {
            if (! in_array($file->getRealPath(), $configExcludedRealPath)) {
                $copyFiles[] = $file;
            }
        }

        return $copyFiles;
    }

    private static function configPaths(): array
    {
        $files = config('erjon_encrypter.paths', []);

        return array_map(function ($item) {
            return base_path($item);
        }, $files);
    }

    private static function configUniqueFilesPath(): array
    {
        $files = config('erjon_encrypter.files', []);

        return array_map(function ($item) {
            return base_path($item);
        }, $files);
    }

    private static function configExcludedRealPath(): array
    {
        $files = config('erjon_encrypter.excluded_files', []);

        return array_map(function ($item) {
            return base_path($item);
        }, $files);
    }
}

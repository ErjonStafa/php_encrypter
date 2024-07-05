<?php

namespace Erjon\PhpEncrypter\Commands;

use Erjon\PhpEncrypter\Facades\Encrypter;
use Illuminate\Console\Command;

class EncryptFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:encrypt';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Encrypt the files of your project';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            foreach (config('erjon_encrypter.paths') as $directory) {
                $directory = base_path($directory);
                $dir  = new \RecursiveDirectoryIterator($directory);
                $flat  = new \RecursiveIteratorIterator($dir);
                $files = new \RegexIterator($flat, '/\.php$/i');
                foreach($files as $file) {
                    Encrypter::proceed($file);
                }
            }


            $this->info('Files encrypted');
        } catch (\Exception $exception) {
            dd($exception);
            $this->error($exception->getMessage());
        }
    }
}

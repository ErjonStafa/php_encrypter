<?php

namespace Erjon\PhpEncrypter\Commands;

use Erjon\PhpEncrypter\Facades\Encrypter;
use Erjon\PhpEncrypter\Support\Files;
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
            $files = Files::get();

            foreach($files as $file) {
                Encrypter::proceed($file);
            }

            $this->info('Files encrypted');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}

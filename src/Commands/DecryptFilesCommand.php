<?php

namespace Erjon\PhpEncrypter\Commands;

use Erjon\PhpEncrypter\Support\Files;
use Erjon\PhpEncrypter\Support\Original;
use Illuminate\Console\Command;

class DecryptFilesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:decrypt';

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
            $key = $this->ask('What is the key?');
            $files = Files::get();
            foreach ($files as $file) {
                Original::restore($file, $key);
            }
            $this->info('Files decrypted');
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
}

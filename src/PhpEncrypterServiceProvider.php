<?php

namespace Erjon\PhpEncrypter;

use Erjon\PhpEncrypter\Commands\DecryptFilesCommand;
use Erjon\PhpEncrypter\Support\Decrypter;
use Erjon\PhpEncrypter\Support\Encrypter;
use Erjon\PhpEncrypter\Commands\EncryptFilesCommand;
use Illuminate\Support\ServiceProvider;

class PhpEncrypterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                EncryptFilesCommand::class,
                DecryptFilesCommand::class
            ]);
        }

        $this->publishes([
            __DIR__ . '/config/erjon_encrypter.php' => config_path('erjon_encrypter.php')
        ], 'erjon_encrypter');
    }

    public function register()
    {
        $this->app->bind('Encrypter', function (){
            return new Encrypter();
        });

        $this->app->bind('Decrypter', function (){
            return new Decrypter();
        }, true);
    }
}

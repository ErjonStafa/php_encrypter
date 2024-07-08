<?php

namespace Erjon\PhpEncrypter;

use Erjon\PhpEncrypter\Support\DecrypterFacade;
use Erjon\PhpEncrypter\Support\EncrypterFacade;
use Erjon\PhpEncrypter\Commands\EncryptFilesCommand;
use Illuminate\Support\ServiceProvider;

class PhpEncrypterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                EncryptFilesCommand::class
            ]);
        }

        $this->publishes([
            __DIR__ . '/config/erjon_encrypter.php' => config_path('erjon_encrypter.php')
        ], 'erjon_encrypter');
    }

    public function register()
    {
        $this->app->bind('Encrypter', function (){
            return new EncrypterFacade();
        });

        $this->app->bind('Decrypter', function (){
            return new DecrypterFacade();
        });
    }
}

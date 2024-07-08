<?php

namespace Erjon\PhpEncrypter;

use Erjon\PhpEncrypter\Facades\Decrypter;
use Erjon\PhpEncrypter\Facades\Encrypter;
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
        $this->app->singleton(Encrypter::class, function (){
            return new EncrypterFacade();
        });

        $this->app->singleton(Decrypter::class, function (){
            return new DecrypterFacade();
        });
    }
}

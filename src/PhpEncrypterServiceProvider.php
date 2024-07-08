<?php

namespace Erjon\PhpEncrypter;

use Erjon\PhpEncrypter\Support\DecrypterFacade;
use Erjon\PhpEncrypter\Support\EncrypterFacade;
use Erjon\PhpEncrypter\Commands\EncryptFilesCommand;
use Illuminate\Support\ServiceProvider;

use Erjon\PhpEncrypter\Facades\Encrypter;
use Erjon\PhpEncrypter\Facades\Decrypter;

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
        $this->app->singleton('Encrypter', EncrypterFacade::class);

        $this->app->singleton('Decrypter', DecrypterFacade::class);
    }
}

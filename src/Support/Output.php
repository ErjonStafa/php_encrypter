<?php

namespace Erjon\PhpEncrypter\Support;
use Erjon\PhpEncrypter\Exceptions\MethodDoesntExistException;

/**
 * @method void line(string $line)
 * @method void success(string $line)
 * @method void error(string $line)
 */
class Output
{
    private array $methods = [
        'success',
        'error',
        'line'
    ];

    public function __call(string $name, array $arguments)
    {
        if (! in_array($name, $this->methods)) {
            throw new MethodDoesntExistException('Method doesn\'t exist!');
        }

        $name = 'call_'. $name;

        foreach ($arguments as $argument) {
            $this->$name($argument);
        }
    }

    private function call_line(string $line)
    {
        echo "{$line}\n";
    }

    private function call_success(string $line)
    {
        echo "\033[32m{$line}\033[0m\n";
    }

    private function call_error(string $line)
    {
        echo "\033[31m{$line}\033[0m\n";
    }
}

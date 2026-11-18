<?php

declare(strict_types=1);

/**
 * Autoloader simples (PSR-4): namespace App\ => pasta src/
 */
spl_autoload_register(function (string $classe): void {
    $prefixo = 'App\\';

    if (strncmp($classe, $prefixo, strlen($prefixo)) !== 0) {
        return;
    }

    $relativa = substr($classe, strlen($prefixo));
    $arquivo = __DIR__ . '/src/' . str_replace('\\', '/', $relativa) . '.php';

    if (is_file($arquivo)) {
        require $arquivo;
    }
});

<?php

declare(strict_types=1);

namespace App\Services;

use RuntimeException;

/**
 * Lançada pelo Service quando os dados não passam nas regras de negócio.
 */
class ValidacaoException extends RuntimeException
{
    /** @param string[] $erros */
    public function __construct(private array $erros)
    {
        parent::__construct(implode(' ', $erros));
    }

    /** @return string[] */
    public function getErros(): array
    {
        return $this->erros;
    }
}

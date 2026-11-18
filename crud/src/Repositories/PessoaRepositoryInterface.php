<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Pessoa;

/**
 * Contrato do repositório. O Service depende desta interface,
 * não da implementação concreta (facilita trocar o banco e testar).
 */
interface PessoaRepositoryInterface
{
    /** @return Pessoa[] */
    public function listarTodas(): array;

    public function buscarPorId(int $id): ?Pessoa;

    public function inserir(Pessoa $pessoa): Pessoa;

    public function atualizar(Pessoa $pessoa): bool;

    public function excluir(int $id): bool;
}

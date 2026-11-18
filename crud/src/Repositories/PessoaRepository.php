<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Models\Pessoa;
use PDO;

/**
 * Repository: único lugar que conversa com o banco (SQL).
 */
class PessoaRepository implements PessoaRepositoryInterface
{
    public function __construct(private PDO $pdo)
    {
    }

    public function listarTodas(): array
    {
        $linhas = $this->pdo
            ->query('SELECT id, nome, idade FROM pessoas ORDER BY nome')
            ->fetchAll();

        return array_map(fn(array $l) => $this->hidratar($l), $linhas);
    }

    public function buscarPorId(int $id): ?Pessoa
    {
        $stmt = $this->pdo->prepare('SELECT id, nome, idade FROM pessoas WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $linha = $stmt->fetch();

        return $linha ? $this->hidratar($linha) : null;
    }

    public function inserir(Pessoa $pessoa): Pessoa
    {
        $stmt = $this->pdo->prepare('INSERT INTO pessoas (nome, idade) VALUES (:nome, :idade)');
        $stmt->execute([
            ':nome'  => $pessoa->getNome(),
            ':idade' => $pessoa->getIdade(),
        ]);

        $pessoa->setId((int) $this->pdo->lastInsertId());

        return $pessoa;
    }

    public function atualizar(Pessoa $pessoa): bool
    {
        $stmt = $this->pdo->prepare(
            'UPDATE pessoas SET nome = :nome, idade = :idade WHERE id = :id'
        );
        $stmt->execute([
            ':nome'  => $pessoa->getNome(),
            ':idade' => $pessoa->getIdade(),
            ':id'    => $pessoa->getId(),
        ]);

        return $stmt->rowCount() > 0;
    }

    public function excluir(int $id): bool
    {
        $stmt = $this->pdo->prepare('DELETE FROM pessoas WHERE id = :id');
        $stmt->execute([':id' => $id]);

        return $stmt->rowCount() > 0;
    }

    private function hidratar(array $linha): Pessoa
    {
        return new Pessoa($linha['nome'], (int) $linha['idade'], (int) $linha['id']);
    }
}

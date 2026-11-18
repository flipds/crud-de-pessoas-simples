<?php

declare(strict_types=1);

namespace App\Models;

/**
 * Model: representa uma pessoa. Não conhece banco nem HTTP.
 */
class Pessoa
{
    public function __construct(
        private string $nome,
        private int $idade,
        private ?int $id = null
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getIdade(): int
    {
        return $this->idade;
    }

    public function setIdade(int $idade): void
    {
        $this->idade = $idade;
    }
}

<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Pessoa;
use App\Repositories\PessoaRepositoryInterface;


class PessoaService
{
    public function __construct(private PessoaRepositoryInterface $repository)
    {
    }

    /** @return Pessoa[] */
    public function listar(): array
    {
        return $this->repository->listarTodas();
    }

    public function buscar(int $id): ?Pessoa
    {
        return $this->repository->buscarPorId($id);
    }

    public function criar(string $nome, mixed $idade): Pessoa
    {
        [$nome, $idade] = $this->validar($nome, $idade);

        return $this->repository->inserir(new Pessoa($nome, $idade));
    }

    public function atualizar(int $id, string $nome, mixed $idade): Pessoa
    {
        [$nome, $idade] = $this->validar($nome, $idade);

        $pessoa = $this->repository->buscarPorId($id);
        if ($pessoa === null) {
            throw new ValidacaoException(['Pessoa não encontrada.']);
        }

        $pessoa->setNome($nome);
        $pessoa->setIdade($idade);
        $this->repository->atualizar($pessoa);

        return $pessoa;
    }

    public function excluir(int $id): bool
    {
        return $this->repository->excluir($id);
    }

    /**
     * Conta caracteres (não bytes), com ou sem a extensão mbstring.
     */
    private function tamanho(string $texto): int
    {
        if (function_exists('mb_strlen')) {
            return mb_strlen($texto);
        }

        // Alternativa sem mbstring: o modificador "u" trata o texto como UTF-8
        return (int) preg_match_all('/./us', $texto);
    }

    /**
     * @return array{0: string, 1: int}
     */
    private function validar(string $nome, mixed $idade): array
    {
        $erros = [];
        $nome = trim($nome);

        if ($nome === '') {
            $erros[] = 'O nome é obrigatório.';
        } elseif ($this->tamanho($nome) > 100) {
            $erros[] = 'O nome deve ter no máximo 100 caracteres.';
        }

        $idadeInt = filter_var($idade, FILTER_VALIDATE_INT);
        if ($idadeInt === false) {
            $erros[] = 'A idade deve ser um número inteiro.';
        } elseif ($idadeInt < 0 || $idadeInt > 150) {
            $erros[] = 'A idade deve estar entre 0 e 150.';
        }

        if ($erros) {
            throw new ValidacaoException($erros);
        }

        return [$nome, $idadeInt];
    }
}
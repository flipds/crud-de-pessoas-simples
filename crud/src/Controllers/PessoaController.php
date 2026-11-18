<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Pessoa;
use App\Services\PessoaService;
use App\Services\ValidacaoException;

/**
 * Controller: recebe a requisição, chama o Service e escolhe a View.
 */
class PessoaController
{
    public function __construct(private PessoaService $service)
    {
    }

    public function listar(): void
    {
        $pessoas = $this->service->listar();
        $mensagem = $_SESSION['mensagem'] ?? null;
        unset($_SESSION['mensagem']);

        $this->render('pessoas/index', compact('pessoas', 'mensagem'));
    }

    public function criar(): void
    {
        $this->render('pessoas/form', [
            'pessoa' => null,
            'erros'  => [],
            'antigo' => ['nome' => '', 'idade' => ''],
        ]);
    }

    public function salvar(): void
    {
        $nome = (string) ($_POST['nome'] ?? '');
        $idade = $_POST['idade'] ?? '';

        try {
            $this->service->criar($nome, $idade);
            $this->redirecionar('Pessoa cadastrada com sucesso!');
        } catch (ValidacaoException $e) {
            $this->render('pessoas/form', [
                'pessoa' => null,
                'erros'  => $e->getErros(),
                'antigo' => ['nome' => $nome, 'idade' => $idade],
            ]);
        }
    }

    public function editar(int $id): void
    {
        $pessoa = $this->service->buscar($id);
        if ($pessoa === null) {
            $this->redirecionar('Pessoa não encontrada.');
        }

        $this->render('pessoas/form', [
            'pessoa' => $pessoa,
            'erros'  => [],
            'antigo' => ['nome' => $pessoa->getNome(), 'idade' => $pessoa->getIdade()],
        ]);
    }

    public function atualizar(int $id): void
    {
        $nome = (string) ($_POST['nome'] ?? '');
        $idade = $_POST['idade'] ?? '';

        try {
            $this->service->atualizar($id, $nome, $idade);
            $this->redirecionar('Pessoa atualizada com sucesso!');
        } catch (ValidacaoException $e) {
            $this->render('pessoas/form', [
                'pessoa' => new Pessoa($nome, (int) $idade, $id),
                'erros'  => $e->getErros(),
                'antigo' => ['nome' => $nome, 'idade' => $idade],
            ]);
        }
    }

    public function excluir(int $id): void
    {
        $ok = $this->service->excluir($id);
        $this->redirecionar($ok ? 'Pessoa excluída com sucesso!' : 'Pessoa não encontrada.');
    }

    private function render(string $view, array $dados = []): void
    {
        extract($dados, EXTR_SKIP);
        $arquivoView = __DIR__ . '/../../views/' . $view . '.php';
        require __DIR__ . '/../../views/layout.php';
    }

    private function redirecionar(string $mensagem): never
    {
        $_SESSION['mensagem'] = $mensagem;
        header('Location: index.php');
        exit;
    }
}

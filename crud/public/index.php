<?php

declare(strict_types=1);

session_start();

require __DIR__ . '/../autoload.php';
require __DIR__ . '/../config/database.php';

use App\Controllers\PessoaController;
use App\Repositories\PessoaRepository;
use App\Services\PessoaService;

// Composição das camadas (injeção de dependência manual)
$pdo        = criarConexao();
$repository = new PessoaRepository($pdo);
$service    = new PessoaService($repository);
$controller = new PessoaController($service);

// Roteamento simples via ?acao=
$acao   = $_GET['acao'] ?? 'listar';
$id     = (int) ($_GET['id'] ?? 0);
$metodo = $_SERVER['REQUEST_METHOD'];

match (true) {
    $acao === 'listar'                          => $controller->listar(),
    $acao === 'criar'                           => $controller->criar(),
    $acao === 'salvar'    && $metodo === 'POST' => $controller->salvar(),
    $acao === 'editar'    && $id > 0            => $controller->editar($id),
    $acao === 'atualizar' && $metodo === 'POST' && $id > 0 => $controller->atualizar($id),
    $acao === 'excluir'   && $metodo === 'POST' && $id > 0 => $controller->excluir($id),
    default => (function () {
        http_response_code(404);
        echo 'Página não encontrada.';
    })(),
};

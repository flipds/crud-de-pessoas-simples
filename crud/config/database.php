<?php

declare(strict_types=1);

/**
 * Cria a conexão PDO com SQLite e garante que a tabela exista.
 * Para usar MySQL, troque apenas o DSN e as credenciais.
 */
function criarConexao(?string $caminhoBanco = null): PDO
{
    $caminhoBanco ??= __DIR__ . '/../database/pessoas.sqlite';

    $pdo = new PDO('sqlite:' . $caminhoBanco);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    $pdo->exec(
        'CREATE TABLE IF NOT EXISTS pessoas (
            id    INTEGER PRIMARY KEY AUTOINCREMENT,
            nome  TEXT    NOT NULL,
            idade INTEGER NOT NULL
        )'
    );

    return $pdo;
}

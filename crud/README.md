# CRUD de Pessoa (PHP + arquitetura em camadas)

CRUD simples de pessoa (nome e idade) em PHP 8+, com PDO e SQLite.

## Estrutura

```
crud-pessoa/
├── autoload.php                  # autoloader PSR-4 (App\ => src/)
├── config/
│   └── database.php              # conexão PDO + criação da tabela
├── database/                     # arquivo pessoas.sqlite é criado aqui
├── public/
│   └── index.php                 # front controller (ponto de entrada + rotas)
├── src/
│   ├── Models/
│   │   └── Pessoa.php            # entidade
│   ├── Repositories/
│   │   ├── PessoaRepositoryInterface.php
│   │   └── PessoaRepository.php  # acesso a dados (SQL)
│   ├── Services/
│   │   ├── PessoaService.php     # regras de negócio e validação
│   │   └── ValidacaoException.php
│   └── Controllers/
│       └── PessoaController.php  # recebe requisição e escolhe a view
└── views/
    ├── layout.php
    └── pessoas/
        ├── index.php             # listagem
        └── form.php              # criar/editar
```

## Fluxo das camadas

`View` → `Controller` → `Service` → `Repository` → `Banco`

- **Controller**: lê `$_GET`/`$_POST`, chama o Service, renderiza a View.
- **Service**: valida (nome obrigatório, idade inteira entre 0 e 150) e orquestra.
- **Repository**: único lugar com SQL (prepared statements).
- **Model**: objeto `Pessoa`, sem dependência de banco ou HTTP.

## Como rodar

Requisitos: PHP 8.1+ com extensão `pdo_sqlite`.

```bash
cd crud-pessoa
php -S localhost:8000 -t public
```

Acesse http://localhost:8000

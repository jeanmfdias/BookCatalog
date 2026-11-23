# Catálogo de Livros

## Stack

* PHP 8.5.12
* Symfony 7.4 LTS
* Docker
* Postgresql 16

## Como executar

Criar o dotenv local `cp .env .env.dev`

Instalar o módulos do PHP e Node.js `composer install && npm install`

Compilar os assets `npm run dev`

Via docker `docker compose --env-file .env.dev up -d`

Criar o banco de dados `docker exec bookcatalog-app php bin/console doctrine:database:create && docker exec bookcatalog-app php bin/console doctrine:schema:create`

Executar as migrações das tabelas `docker exec bookcatalog-app php bin/console doctrine:migrations:migrate`

Para rodar os testes `docker exec bookcatalog-app composer run test`

Para rodar os testes com comentários `docker exec bookcatalog-app composer run testdox`

## Documentação

Nesse arquivo está documentado todos os comandos executados em terminal [`docs/TERMINAL_COMMANDS.md`](docs/TERMINAL_COMMANDS.md)

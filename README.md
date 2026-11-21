# Catálogo de Livros

## Stack

* PHP 8.5.12
* Symfony 7.4 LTS
* Docker
* Postgresql 16

## Como executar

Criar o dotenv local `cp .env .env.dev`

Compilar os assets `npm run dev`

Via docker `docker compose --env-file .env.dev up -d`

Para rodar os testes `docker exec bookcatalog-app php bin/phpunit`

Para rodar os testes com comentários `docker exec bookcatalog-app php bin/phpunit --testdox`

## Documentação

Nesse arquivo está documentado todos os comandos executados em terminal [`docs/TERMINAL_COMMANDS.md`](docs/TERMINAL_COMMANDS.md)

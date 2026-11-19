```bash

composer create-project symfony/skeleton:"7.4.*" my_project_directory

composer require webapp

php bin/console make:controller SubjectsController

php bin/console make:controller AuthorsController

php bin/console make:controller BooksController

php bin/console make:entity SubjectEntity

php bin/console make:entity AuthorEntity

php bin/console make:entity BookEntity

docker compose --env-file .env.dev up --build -d

docker exec bookcatalog-app php bin/console make:migration

docker exec bookcatalog-app php bin/console doctrine:migrations:migrate

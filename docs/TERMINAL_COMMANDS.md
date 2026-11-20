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

composer require symfony/webpack-encore-bundle symfony/ux-turbo symfony/stimulus-bundle

npm install

npm i bootstrap@6.0.0-alpha.1 --save-dev

npm i sass-loader@^17.0.0 sass --save-dev

composer require symfony/ux-pagination

php bin/console make:form SubjectFilter

php bin/console make:form CreateSubject

php bin/console make:form EditSubject

docker exec bookcatalog-app php bin/console doctrine:schema:validate

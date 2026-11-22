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

php bin/console make:form AuthorFilter

php bin/console make:form AuthorCreate

php bin/console make:form AuthorEdit

php bin/console make:form BookFilter

php bin/console make:form BookCreate

php bin/console make:form BookEdit

docker exec bookcatalog-app php bin/console --env=test doctrine:database:create

docker exec bookcatalog-app php bin/console --env=test doctrine:schema:create

composer require --dev dama/doctrine-test-bundle

composer require --dev doctrine/doctrine-fixtures-bundle

php bin/console make:fixtures # 3x para cada Entity

docker exec bookcatalog-app php bin/console --env=test doctrine:database:drop --force

docker exec bookcatalog-app php bin/console --env=test doctrine:database:create

docker exec bookcatalog-app php bin/console --env=test doctrine:schema:create

docker exec bookcatalog-app php bin/console doctrine:migrations:generate 

docker exec bookcatalog-app php bin/console doctrine:migrations:migrate

docker exec bookcatalog-app php bin/console doctrine:migrations:generate

docker exec bookcatalog-app php bin/console doctrine:migrations:migrate

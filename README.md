## Instructions for running

1. Clone the repository.
2. Run `docker-compose up -d`.
3. Run `docker-compose exec php /bin/bash`.
4. Run `composer install`.
5. Run `php bin/console doctrine:migration:migrate`.
6. Run the command to parse the products: `php bin/console app:parse-products && php bin/console messenger:consume -vv`.
7. View the list of products using the API: `http://localhost:8081/product`.
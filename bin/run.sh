#!/bin/bash

docker-compose up -d --build

docker exec -it nebula_api_php php bin/console doctrine:migrations:migrate --no-interaction
docker exec -it nebula_api_php php bin/console doctrine:fixtures:load --no-interaction

docker exec -it nebula_api_php  php bin/console messenger:consume payments

#!/bin/bash

docker-compose up -d --build

docker-compose exec php php bin/console doctrine:migrations:migrate --no-interaction
docker-compose exec php php bin/console doctrine:fixtures:load --no-interaction

docker-compose exec php php bin/console messenger:consume payments

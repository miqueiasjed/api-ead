## API LARAVEL Plataforma de Ensino Online

## PASSOS PARA INSTALAÇÃO

## PASSO 1
Clonar repositório github

## Passo 2 - Configurar DB no .env
DB_CONNECTION=pgsql

DB_HOST=pgsql

DB_PORT=5432

DB_DATABASE=

DB_USERNAME=

DB_PASSWORD=

## Passo 3 - Rodar Docker
docker-compose up -d

## Passo 4 - Instalar dependencias laravel
docker-composer exec app bash

composer install

php artisan key:generate 

php artisan migrate --seed

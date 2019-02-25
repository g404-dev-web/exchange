# Exchange

Un clone très léger de stackoverflow destiné aux débutants.

## Technos

PHP7 / Laravel / SQL

## Pour contribuer :

- `git clone https://gitlab.com/simplon-roanne/exchange`
- `cd exchange`
- `composer install`
-  Copier .env.example vers .env et remplir les informations de votre base de donnée DB
- `php artisan migrate`
- `php artisan db:seed`

## Mise à jour du projet

- `php artisan migrate:refresh --seed`
# Reporter un bug

Vous devez créer un [nouvel Issue](https://gitlab.com/simplon-roanne/exchange/issues/new?issue%5Bassignee_id%5D=&issue%5Bmilestone_id%5D=) et décrire le bug rencontré avec le plus de détails possibles.
Utilisez le template suivant pour être sûrs de ne rien oublier : 
```md
# test
```

# Proposer une amélioration


# Contribuer au code source pour un correctif ou une amélioration

## Installation du projet en local pour test ou contribution

- `git clone https://gitlab.com/simplon-roanne/exchange`
- `cd exchange`
- `composer install`
-  Copier .env.example vers .env et remplir les informations d'une base de données disponible
- `php artisan migrate`
- `php artisan db:seed`

## Mise à jour du projet local

- `git pull`
- `php artisan migrate:refresh --seed`

## Conventions de code à respecter

## Comment envoyer les modifications à Gitlab